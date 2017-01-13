<?php
foreach (amministrazionetrasparente_getarray() as $inner) {

    echo '<ul><li><b>'.$inner[0].'</b>';
    $atreturn = '';
    foreach ($inner[1] as $value) {
        $atreturn .= '<li><a href="' . get_term_link( $value, 'tipologie' ) . '" title="' . $value . '">' . $value . '</a></li>';
    }
    echo '<ul>'.$atreturn.'</ul>';

    echo '</li></ul>';
}
?>