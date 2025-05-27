const { InspectorControls, useBlockProps } = wp.blockEditor || wp.editor;
const { PanelBody, RangeControl, SelectControl, ToggleControl } = wp.components;
const { PropTypes } = wp.element;

const headingOptions = [
    { label: 'H1', value: 'h1' },
    { label: 'H2', value: 'h2' },
    { label: 'H3', value: 'h3' },
    { label: 'H4', value: 'h4' },
    { label: 'H5', value: 'h5' },
    { label: 'H6', value: 'h6' },
];

wp.blocks.registerBlockType('amministrazione-trasparente/page-widget', {
    title: 'Amministrazione Trasparente',
    icon: 'grid-view',
    category: 'widgets',
    keywords: [ 'amministrazione', 'trasparente', 'sezioni', 'page', 'widget' ],
    attributes: {
        col: { type: 'string', default: '2' },
        groupHeadingLevel: { type: 'string', default: 'h3' },
        showOpacity: { type: 'boolean', default: false },
        expandableNavigation: { type: 'boolean', default: false },
        anchor: { type: 'string' },
    },
    supports: {
        anchor: true
    },
    edit: function(props) {
        const { attributes, setAttributes, className, style } = props;
        const columns = parseInt(attributes.col) || 2;
        const blockProps = useBlockProps(); 

        // Example static sections for preview
        const sections = [
            { title: 'Sezione 1', terms: ['Term 1', 'Term 2'] },
            { title: 'Sezione 2', terms: ['Term 3', 'Term 4'] },
            { title: 'Sezione 3', terms: ['Term 5'] },
            { title: 'Sezione 4', terms: ['Term 6', 'Term 7'] },
        ];

        const GroupHeadingTag = attributes.groupHeadingLevel || 'h3';

        // Plugin style only for "minimal" style
        const isPluginStyle = className && className.includes('is-style-minimal');

        return [
            wp.element.createElement(
                InspectorControls,
                {},
                wp.element.createElement(
                    PanelBody,
                    { title: 'Impostazioni blocco', initialOpen: true },
                    wp.element.createElement(RangeControl, {
                        label: 'Colonne',
                        value: columns,
                        onChange: (val) => setAttributes({ col: String(val) }),
                        min: 1,
                        max: 4
                    }),
                    wp.element.createElement(SelectControl, {
                        label: 'Livello Titolo Gruppo',
                        value: attributes.groupHeadingLevel,
                        options: headingOptions,
                        onChange: (val) => setAttributes({ groupHeadingLevel: val })
                    }),
                    wp.element.createElement(ToggleControl, {
                        label: 'Opacizza termini senza contenuto',
                        checked: attributes.showOpacity,
                        onChange: (val) => setAttributes({ showOpacity: val })
                    }),
                    wp.element.createElement(ToggleControl, {
                        label: 'Navigazione espandibile',
                        checked: attributes.expandableNavigation,
                        onChange: (val) => setAttributes({ expandableNavigation: val }),
                        help: 'Mostra solo i titoli e permetti di espandere le sezioni'
                    })
                )
            ),
            wp.element.createElement(
                'div',
                blockProps,
                wp.element.createElement(
                    'section',
                    {
                        className: `at-sezioni-block at-sezioni-cols-${columns}`,
                    },
                    wp.element.createElement(
                        'div',
                        { className: 'at-sezioni-grid' },
                        sections.map((section, idx) =>
                            wp.element.createElement(
                                'div',
                                { key: idx, className: 'at-sezioni-item' },
                                wp.element.createElement(
                                    GroupHeadingTag,
                                    { className: 'at-sezioni-group-title' },
                                    section.title
                                ),
                                wp.element.createElement(
                                    'ul',
                                    { className: 'at-sezioni-terms' },
                                    section.terms.map((term, tIdx) =>
                                        wp.element.createElement(
                                            'li',
                                            { key: tIdx },
                                            wp.element.createElement('a', { href: '#' }, term)
                                        )
                                    )
                                )
                            )
                        )
                    )
                )
            )
        ];
    },
    save: function() {
        return null; // Dynamic block
    }
});

// Register block styles for the block
wp.blocks.registerBlockStyle('amministrazione-trasparente/page-widget', {
    name: 'default',
    label: 'Default',
    isDefault: true,
});
wp.blocks.registerBlockStyle('amministrazione-trasparente/page-widget', {
    name: 'minimal',
    label: 'Minimal',
});

const BlockEdit = (props) => {
    // ... edit function content ...
};

BlockEdit.propTypes = {
    attributes: PropTypes.shape({
        col: PropTypes.string,
        groupHeadingLevel: PropTypes.string,
        showOpacity: PropTypes.bool
    }),
    setAttributes: PropTypes.func.isRequired,
    className: PropTypes.string
};