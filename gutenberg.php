<?php

class AT_Gutenberg_Blocks {

    public function __construct() {
        add_action('init', [$this, 'register_blocks']);
        add_action('wp_enqueue_scripts', [$this, 'register_frontend_scripts']);
        add_shortcode('amministrazione-trasparente', [$this, 'shortcode_amministrazione_trasparente']); // <-- Add this line
    }

    public function register_frontend_scripts() {
        wp_register_script(
            'at-frontend',
            plugins_url('includes/js/gutenberg-page-widget.js',  __FILE__ ),
            array('jquery'),
            filemtime(plugin_dir_path(__FILE__) . 'includes/js/gutenberg-page-widget.js'),
            true
        );
    }

    public function register_blocks() {
        // Enqueue block editor script
        wp_register_script(
            'at-sezioni-block',
            plugins_url('includes/js/block.js', __FILE__),
            [ 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-block-editor' ],
            filemtime(plugin_dir_path(__FILE__) . 'includes/js/block.js')
        );

        wp_register_style(
            'at-sezioni-block-style',
            plugins_url('includes/css/gutenberg-page-widget.css', __FILE__),
            [],
            filemtime(plugin_dir_path(__FILE__) . 'includes/css/gutenberg-page-widget.css')
        );

        register_block_type('amministrazione-trasparente/page-widget', [
            'editor_script' => 'at-sezioni-block',
            'style'         => 'at-sezioni-block-style',
            'attributes'    => [
                'col' => [ 'type' => 'string', 'default' => '2' ],
                'groupHeadingLevel' => [ 'type' => 'string', 'default' => 'h3' ],
                'showOpacity' => [ 'type' => 'boolean', 'default' => false ],
                'expandableNavigation' => [ 'type' => 'boolean', 'default' => false ],
                'anchor' => [ 'type' => 'string' ]
            ],
            'supports' => [
                'customClassName' => true,
                'anchor' => true,
                'spacing' => [
                    'margin' => false,
                    'padding' => false,
                ],
            ],
            'render_callback' => [$this, 'render_at_sezioni_block'],
            'style_variations' => [
                [
                    'name' => 'minimal',
                    'label' => __('Minimal', 'amministrazione-trasparente'),
                    'isDefault' => false,
                ],
            ],
        ]);
    }

    public function render_at_sezioni_block($attributes, $content, $block) {
        $col = isset($attributes['col']) ? $attributes['col'] : '2';
        $groupHeadingLevel = isset($attributes['groupHeadingLevel']) ? $attributes['groupHeadingLevel'] : 'h3';
        $showOpacity = !empty($attributes['showOpacity']);

        $anchor = !empty($attributes['anchor']) ? sanitize_title($attributes['anchor']) : '';

        $allowed_headings = ['h1','h2','h3','h4','h5','h6'];
        if (!in_array($groupHeadingLevel, $allowed_headings)) $groupHeadingLevel = 'h3';

        // Robustly detect block style for frontend and backend
        $block_style = 'default';
        if (isset($block->style)) {
            $block_style = $block->style;
        } elseif (
            (isset($block->className) && strpos($block->className, 'is-style-minimal') !== false) ||
            (isset($attributes['className']) && strpos($attributes['className'], 'is-style-minimal') !== false)
        ) {
            $block_style = 'minimal';
        }
        $plugin_style = ($block_style === 'minimal');

        // Get all groups (sections)
        if ( ! function_exists('at_get_taxonomy_groups') || ! function_exists('at_getGroupConf') ) {
            return '';
        }
        $groups = at_get_taxonomy_groups();

        $expandableNavigation = !empty($attributes['expandableNavigation']);
        
        ob_start();
        if ($plugin_style) echo '<div class="at-sezioni-plugin-style' . ($expandableNavigation ? ' at-sezioni-expandable' : '') . '">';
        ?>
        <section
            class="at-sezioni-block at-sezioni-cols-<?php echo esc_attr($col); ?>"
        >
            <div class="at-sezioni-grid">
                <?php foreach ($groups as $groupName): 
                    $tipologieGruppo = at_getGroupConf( sanitize_title( $groupName ) );
                    if (empty($tipologieGruppo)) continue;
                ?>
                    <div class="at-sezioni-item">
                        <<?php echo esc_html($groupHeadingLevel); ?> class="at-sezioni-group-title" id="<?php echo sanitize_title( $groupName ); ?>"><?php echo esc_html($groupName); ?></<?php echo esc_html($groupHeadingLevel); ?>>
                        <ul class="at-sezioni-terms">
                            <?php foreach ($tipologieGruppo as $idTipologia):
                                $term = get_term_by('id', $idTipologia, 'tipologie');
                                if (!$term) continue;
                                $has_content = (int) get_posts([
                                    'post_type' => 'amm-trasparente',
                                    'tax_query' => [
                                        [
                                            'taxonomy' => 'tipologie',
                                            'field' => 'id',
                                            'terms' => $term->term_id,
                                        ]
                                    ],
                                    'posts_per_page' => 1,
                                    'fields' => 'ids',
                                ]);
                                $is_empty = !$has_content;
                                ?>
                                <li>
                                    <a href="<?php echo esc_url(get_term_link($term)); ?>"
                                       title="<?php echo esc_attr($term->name); ?>"
                                       <?php if ($showOpacity && $is_empty): ?>
                                           class="at-sezioni-term-opacity"
                                           aria-label="<?php echo esc_attr($term->name . ' (nessun contenuto)'); ?>"
                                       <?php endif; ?>
                                    >
                                        <?php echo esc_html($term->name); ?>
                                        <?php if ($showOpacity && $is_empty): ?>
                                            <span class="screen-reader-text">(nessun contenuto)</span>
                                        <?php endif; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php
        if ($plugin_style) echo '</div>';
        
        // Enqueue frontend script only if expandable navigation is enabled
        if ($expandableNavigation) {
            wp_enqueue_script(
                'at-frontend',
                plugins_url('includes/js/gutenberg-page-widget.js',  __FILE__ ),
                array('jquery'),
                filemtime(plugin_dir_path(  __FILE__ ) . 'includes/js/gutenberg-page-widget.js'),
                true
            );

            
        }
        
        return ob_get_clean();
    }

    /**
     * Shortcode handler for [amministrazione-trasparente]
     * Usage: [amministrazione-trasparente col="2" group_heading_level="h3" show_opacity="0" expandable_navigation="0" anchor=""]
     */
    public function shortcode_amministrazione_trasparente($atts = [], $content = null) {
        $atts = shortcode_atts([
            'col' => '2',
            'group_heading_level' => 'h3',
            'show_opacity' => '0',
            'expandable_navigation' => '0',
            'anchor' => '',
            'class' => '',
            'style' => '',
        ], $atts, 'amministrazione-trasparente');

        // Map shortcode atts to block attributes
        $attributes = [
            'col' => $atts['col'],
            'groupHeadingLevel' => $atts['group_heading_level'],
            'showOpacity' => filter_var($atts['show_opacity'], FILTER_VALIDATE_BOOLEAN),
            'expandableNavigation' => filter_var($atts['expandable_navigation'], FILTER_VALIDATE_BOOLEAN),
            'anchor' => $atts['anchor'],
            'className' => $atts['class'],
            'style' => $atts['style'],
        ];

        // Simulate $block object for style detection
        $block = (object)[
            'style' => $atts['style'],
            'className' => $atts['class'],
        ];

        return $this->render_at_sezioni_block($attributes, '', $block);
    }
}

new AT_Gutenberg_Blocks();