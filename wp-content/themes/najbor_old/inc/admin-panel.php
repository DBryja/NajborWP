<?php
// Dodaj nowy widok "Na sprzedaż" do menu podtypów
function add_na_sprzedaz_view($views) {
	$current = (isset($_GET['na_sprzedaz']) && $_GET['na_sprzedaz'] == 1) ? 'class="current"' : '';
	$views['na_sprzedaz'] = '<a href="' . admin_url('edit.php?post_type=prace&na_sprzedaz=1') . '" ' . $current . '>Na sprzedaż</a>';
	return $views;
}
add_filter('views_edit-prace', 'add_na_sprzedaz_view');

// Filtrowanie postów w widoku "Na sprzedaż"
function filter_prace_by_na_sprzedaz($query) {
	if (!is_admin() || !$query->is_main_query()) {
		return;
	}

	if ($query->get('post_type') == 'prace' && isset($_GET['na_sprzedaz']) && $_GET['na_sprzedaz'] == 1) {
		$meta_query = [
			[
				'key' => 'na_sprzedaz',
				'value' => '1',
				'compare' => '='
			]
		];
		$query->set('meta_query', $meta_query);
	}
}
add_action('pre_get_posts', 'filter_prace_by_na_sprzedaz');
// DODATKOWE POLA W PANELU ADMINISTRACYJNYM >>>

// <<< USUWANIE ZBĘDNYCH ELEMENTÓW Z PANELU ADMINISTRACYJNEGO
// Usuwa elementy menu komentarzy z panelu administracyjnego
function remove_comment_menu() {
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'remove_comment_menu');

// Usuwa widgety komentarzy z pulpitu nawigacyjnego
function remove_comment_dashboard_widgets() {
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('wp_dashboard_setup', 'remove_comment_dashboard_widgets');

// Wyłącza funkcje związane z komentarzami
function disable_comments_support() {
	// Wyłącza wsparcie dla komentarzy w typach postów
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if(post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
}
add_action('admin_init', 'disable_comments_support');

// Usuwa opcje z menu administracyjnego
function disable_comments_admin_bar() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'disable_comments_admin_bar');


// Usuwa elementy menu postów z panelu administracyjnego
function remove_post_menu() {
	remove_menu_page('edit.php');
}
add_action('admin_menu', 'remove_post_menu');

// Usuwa widgety postów z pulpitu nawigacyjnego
function remove_post_dashboard_widgets() {
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
}
add_action('wp_dashboard_setup', 'remove_post_dashboard_widgets');

// Wyłącza wsparcie dla postów
function disable_posts_support() {
	// Wyłącza wsparcie dla domyślnych postów
	remove_post_type_support('post', 'editor');
	remove_post_type_support('post', 'comments');
	remove_post_type_support('post', 'trackbacks');
	remove_post_type_support('post', 'revisions');
	remove_post_type_support('post', 'author');
	remove_post_type_support('post', 'excerpt');
	remove_post_type_support('post', 'page-attributes');
	remove_post_type_support('post', 'thumbnail');
	remove_post_type_support('post', 'custom-fields');
}
add_action('init', 'disable_posts_support');

function enforce_thumbnail(){
    global $pagenow;

    if ($pagenow === 'post-new.php' || $pagenow === 'post.php') {
		?>
		<script type="text/javascript">
			document.addEventListener('DOMContentLoaded', function() {
				const thumbnail = document.querySelector('#postimagediv');
				thumbnail.style.display = 'none';
			});
		</script>
	    <?php
	}
}
function enforce_single_category_radio_buttons() {
	global $pagenow;
	$post_type = isset($_GET['post_type']) ? $_GET['post_type'] : (isset($_GET['post']) ? get_post_type($_GET['post']) : '');

	if (($pagenow === 'post-new.php' && $post_type === 'prace') || ($pagenow === 'post.php' && $post_type === 'prace')) {
		?>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                const checkboxes = document.querySelectorAll('#katpracechecklist input[type="checkbox"]');
                checkboxes.forEach(function(checkbox) {
                    checkbox.type = 'radio';
                    checkbox.name = 'tax_input[katprace][]';
                });

                if (checkboxes.length > 0) {
                    checkboxes[0].required = true;
                }

                document.getElementById('post').addEventListener('submit', function(e) {
                    const checkedCheckboxes = document.querySelectorAll('#katpracechecklist input[type="radio"]:checked');
                    if (checkedCheckboxes.length !== 1) {
                        alert('Proszę wybrać jedną z kategorii.');
                        e.preventDefault();
                        return false;
                    }
                });
            });
        </script>
		<?php
	}
}
add_action('admin_footer', 'enforce_single_category_radio_buttons');


function enforce_single_category_validation($post_id, $post, $update) {
	if ($post->post_type != 'prace') {
		return;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	$categories = isset($_POST['tax_input']['katprace']) ? $_POST['tax_input']['katprace'] : [];

	// Remove the default '0' value
	$categories = array_filter($categories, function($value) {
		return $value !== '0';
	});

	if (count($categories) !== 1) {
		set_transient('enforce_single_category_error', 'Please select exactly one category.', 10);
		// Redirect back to the edit screen
		wp_safe_redirect(add_query_arg(array('post' => $post_id, 'action' => 'edit'), admin_url('post.php')));
		exit;
	}
}
add_action('save_post', 'enforce_single_category_validation', 10, 3);


function display_enforce_single_category_error() {
	if ($error = get_transient('enforce_single_category_error')) {
		?>
        <div class="notice notice-error is-dismissible">
            <p><?php echo $error; ?></p>
        </div>
		<?php
		delete_transient('enforce_single_category_error');
	}
}
add_action('admin_notices', 'display_enforce_single_category_error');

function enforce_single_thumbnail(){
    global $pagenow;

    if ($pagenow === 'post-new.php' || $pagenow === 'post.php') {
        ?>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                const thumbnailInput = document.querySelector('#postimagediv input');
                thumbnailInput.required = true;
            });
        </script>
        <?php
    }
}
add_action('admin_footer', 'enforce_single_thumbnail');
function output_custom_fields_js_data() {
	global $post;

	// Only run this on the post edit screen
	if (!is_admin() || !in_array(get_current_screen()->base, array('post', 'edit'))) {
		return;
	}

	// Check if the post type is 'prace'
	if (get_post_type($post->ID) !== 'prace') {
		return;
	}

	// Fetch custom fields data
	$custom_fields = array(
		'tytul' => get_field('tytul', $post->ID),
		'Obraz' => get_field('Obraz', $post->ID),
		'na_sprzedaz' => get_field('na_sprzedaz', $post->ID),
		'opis' => get_field('opis', $post->ID),
		'metoda' => get_field('metoda', $post->ID),
		'wymiary' => get_field('wymiary', $post->ID),
		'oprawa' => get_field('oprawa', $post->ID),
		'rok_powstania' => get_field('rok_powstania', $post->ID),
		'tytul_en' => get_field('tytul_en', $post->ID),
		'opis_en' => get_field('opis_en', $post->ID),
		'metoda_en' => get_field('metoda_en', $post->ID),
		'oprawa_en' => get_field('oprawa_en', $post->ID),
		'tytul_fr' => get_field('tytul_fr', $post->ID),
		'opis_fr' => get_field('opis_fr', $post->ID),
		'metoda_fr' => get_field('metoda_fr', $post->ID),
		'oprawa_fr' => get_field('oprawa_fr', $post->ID)
	);

	// Output the custom fields data as a JavaScript variable
	echo '<script type="text/javascript">';
	echo 'var customFieldsData = ' . json_encode($custom_fields) . ';';
//    echo 'console.log(customFieldsData);';
	echo '</script>';
}
add_action('admin_footer', 'output_custom_fields_js_data');
function fill_custom_fields_js() {
	global $post;
	// Only run this on the post edit screen
	if (!is_admin() || !in_array(get_current_screen()->base, array('post', 'edit')))
		return;
	// Check if the post type is 'prace'
	if (get_post_type($post->ID) !== 'prace')
		return;
	?>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            console.log(customFieldsData);
            if (typeof customFieldsData !== 'undefined') {
                for (var key in customFieldsData) {
                    if (customFieldsData.hasOwnProperty(key)) {
                        var fieldValue = customFieldsData[key];
                        console.log(fieldValue);
                        var fieldDiv = document.querySelector('div[data-name="' + key + '"]');
                        if (fieldDiv) {
                            var input = fieldDiv.querySelector('input, textarea, img');
                            if (input) {
                                if (input.type === 'checkbox') {
                                    input.checked = fieldValue ? true : false;
                                } else if (input.name === 'acf[field_668f90d3a5cc7]') {
                                    input.value = fieldValue.ID;
                                } else {
                                    input.value = fieldValue.replace(/<\/[^>]+(>|$)/g, "");
                                }
                            }
                        }
                    }
                }
            }
        });
    </script>
	<?php
}
add_action('admin_footer', 'fill_custom_fields_js');


?>
