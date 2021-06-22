<?php
foreach (amministrazionetrasparente_getarray() as $inner) {

    echo '<ul><li><b>'.esc_html($inner[0]).'</b>';
    $atreturn = '';
    foreach ($inner[1] as $value) {
        $atreturn .= '<li><a href="' . get_term_link( get_term_by('name', $value, 'tipologie'), 'tipologie' ) . '" title="' . $value . '">' . $value . '</a></li>';
    }
    echo '<ul>'.esc_html( $atreturn ).'</ul>';

    echo '</li></ul>';
}
?>