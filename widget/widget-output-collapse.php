<!--CSS Code-->
<style type="text/css">
.row {vertical-align: top; height:auto !important; font-size: 0.9em;}
.list {display:none;}
.show {display:none;}
.hide:target + .show {display:inline;}
.hide:target {display:none;}
.hide:target ~ .list {display:inline;}
@media print {.hide, .show {display:none;}}
</style>
 
<?php
$atcontatore = 0;
foreach (amministrazionetrasparente_getarray() as $inner) {

    echo '<div class="row">
    <a href="#hide'.++$atcontatore.'" class="hide" id="hide'.$atcontatore.'">[+]&nbsp;<b>'.$inner[0].'</b></a>
    <a href="#show'.$atcontatore.'" class="show" id="show'.$atcontatore.'">[-]&nbsp;<b>'.$inner[0].'</b></a>
    <div class="list">';
    $atreturn = '';
    foreach ($inner[1] as $value) {
        $atreturn .= '<li><a href="' . get_term_link( get_term_by('name', $value, 'tipologie'), 'tipologie' ) . '" title="' . esc_attr( $value ) . '">' . esc_html( $value ) . '</a></li>';
    }
    echo '<ul>'.$atreturn.'</ul>';

    echo '</div></div>';
}
?>