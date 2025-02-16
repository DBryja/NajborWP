<?php
// Dodaj kolumny do listy postów
add_filter('manage_prace_posts_columns', function($columns) {
    $columns['priorytet'] = 'Priorytet';
    $columns['na_sprzedaz'] = 'Dostępne';
    $columns['katprace'] = 'Kategoria';
    return $columns;
});

// Oznacz które kolumny mają być sortowalne
add_filter('manage_edit-prace_sortable_columns', function($columns) {
    $columns['priorytet'] = 'priorytet';
    $columns['na_sprzedaz'] = 'na_sprzedaz';
    return $columns;
});

// Wypełnij kolumny danymi
add_action('manage_prace_posts_custom_column', function($column_name, $post_id) {
    if ($column_name === 'katprace') {
        $terms = get_the_terms($post_id, 'katprace');
        if ($terms && !is_wp_error($terms)) {
            echo implode(', ', wp_list_pluck($terms, 'name'));
        }
    }

    if ($column_name === 'priorytet') {
        $priorytet = get_field('priorytet', $post_id);
        echo $priorytet ? esc_html($priorytet) : 0;
    }

    if ($column_name === 'na_sprzedaz') {
        $dostepne = get_field('na_sprzedaz', $post_id);
        echo $dostepne ? "Dostępne" : '-';
    }
}, 10, 2);

// Obsługa sortowania
add_action('pre_get_posts', function($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }

    $orderby = $query->get('orderby');

    if ('priorytet' === $orderby) {
        $query->set('meta_key', 'priorytet');
        $query->set('orderby', 'meta_value_num');
    }

    if ('na_sprzedaz' === $orderby) {
        $query->set('meta_key', 'na_sprzedaz');
        $query->set('orderby', 'meta_value_num');
    }
});

// Dodaj obsługę quick edit
add_action('quick_edit_custom_box', function($column_name, $post_type) {
    if ($post_type !== 'prace') return;

    switch($column_name) {
        case 'priorytet':
            ?>
            <fieldset class="inline-edit-col-right">
                <div class="inline-edit-col">
                    <label>
                        <span class="title">Priorytet</span>
                        <span class="input-text-wrap">
                            <input type="number" name="priorytet" value="" min="0" max="100">
                        </span>
                    </label>
                </div>
            </fieldset>
            <?php
            break;
    }
}, 10, 2);

// Zapisz dane z quick edit
add_action('save_post_prace', function($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // Zapisz priorytet
    if (isset($_POST['priorytet'])) {
        update_field('priorytet', sanitize_text_field($_POST['priorytet']), $post_id);
    }
});

// Dodaj obsługę JavaScript dla quick edit
add_action('admin_footer', function() {
    global $post_type;
    if ($post_type !== 'prace') return;
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            // Obsługa quick edit
            var $wp_inline_edit = inlineEditPost.edit;
            inlineEditPost.edit = function(id) {
                $wp_inline_edit.apply(this, arguments);
                var post_id = 0;
                if (typeof(id) == 'object') {
                    post_id = parseInt(this.getId(id));
                }

                if (post_id > 0) {
                    var $row = $('#post-' + post_id);
                    var priorytet = $row.find('.column-priorytet').text();

                    // Wypełnij pole priorytet
                    $('#edit-' + post_id).find('input[name="priorytet"]').val(priorytet);
                }
            };
        });
    </script>
    <?php
});

// Dodaj filtry do listy postów w admin panelu
add_action('restrict_manage_posts', function() {
    global $typenow;

    if ($typenow === 'prace') {
        // Filtr dla kategorii
        $taxonomy = 'katprace';
        $selected = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
        $terms = get_terms([
            'taxonomy' => $taxonomy,
            'hide_empty' => false,
        ]);

        if (!empty($terms)) {
            echo '<select name="' . esc_attr($taxonomy) . '">';
            echo '<option value="">Wszystkie kategorie</option>';

            foreach ($terms as $term) {
                $selected_attr = selected($selected, $term->slug, false);
                echo sprintf(
                    '<option value="%s" %s>%s</option>',
                    esc_attr($term->slug),
                    $selected_attr,
                    esc_html($term->name)
                );
            }

            echo '</select>';
        }
    }
});

// Modyfikuj query na podstawie wybranych filtrów
add_action('pre_get_posts', function($query) {
    global $pagenow;

    if (is_admin() && $pagenow === 'edit.php' &&
        isset($_GET['post_type']) && $_GET['post_type'] === 'prace') {

        $taxonomy = 'katprace';
        if (isset($_GET[$taxonomy]) && !empty($_GET[$taxonomy])) {
            $query->set('tax_query', array(
                array(
                    'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => sanitize_text_field($_GET[$taxonomy])
                )
            ));
        }
    }
});

// Wymuszenie wyboru max 1 kategorii
function enforce_single_category_radio_buttons() {
    global $pagenow, $post;

    if ($pagenow === 'post.php' && isset($post->post_type) && $post->post_type === 'prace') {
        ?>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                const categoryInputs = document.querySelectorAll('#taxonomy-katprace input[type="checkbox"]');

                categoryInputs.forEach(input => {
                    input.addEventListener('change', function() {
                        categoryInputs.forEach(i => {
                            if (i !== input) {
                                i.checked = false;
                            }
                        });
                    });
                });
            });
        </script>
        <?php
    }
}
add_action('admin_footer', 'enforce_single_category_radio_buttons');

// Wymuś wybór jednej kategorii
add_action('save_post_prace', function($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!isset($_POST['post_type']) || $_POST['post_type'] !== 'prace') return;
    if (!current_user_can('edit_post', $post_id)) return;

    // Sprawdź, czy post ma przypisaną kategorię
    $terms = wp_get_post_terms($post_id, 'katprace');
    if (empty($terms)) {
        wp_die('Musisz wybrać dokładnie jedną kategorię przed zapisaniem.', 'Błąd zapisu', [
            'back_link' => true
        ]);
    }
}, 10, 1);

// Wyłącz przycisk przed wybraniem
add_action('admin_footer', function() {
    global $post_type;
    if ($post_type !== 'prace') return;
    ?>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const categoryInputs = document.querySelectorAll('#taxonomy-katprace input[type="checkbox"]');
            const updateButton = document.querySelector('#publish'); // Przycisk "Aktualizuj"
            const checkCategorySelection = () => {
                let isChecked = false;
                categoryInputs.forEach(input => {
                    if (input.checked) {
                        isChecked = true;
                    }
                });

                updateButton.disabled = !isChecked;
            };
            updateButton.disabled = true;
            categoryInputs.forEach(input => {
                input.addEventListener('change', checkCategorySelection);
            });
        });
    </script>
    <?php
});

// Ukryj domyślne pole miniatury na stronie edycji postów
function enforce_thumbnail() {
    echo '<style>#postimagediv { display: none; }</style>';
}
add_action('admin_footer', 'enforce_thumbnail');
// test
?>