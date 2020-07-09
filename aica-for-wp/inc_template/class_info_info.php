<?php
$html = '<div class="div_non_summary_table" >';
$html .= '<table class="table table-sm table-striped">';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th colspan="5" >Class Info</th>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<th>Ticker</th>';
$html .= '<th>Name</th>';
$html .= '<th>CUSIP</th>';
$html .= '<th>Inception</th>';
$html .= '<th>Div Freq</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';
foreach($get_fund_info As $info) {
$html .= '<tr>';
$html .= '<td>' . $info['ticker'] . '</td>';
$html .= '<td>' . $info['class_name'] . '</td>';
$html .= '<td>' . $info['cusip'] . '</td>';
$html .= '<td>' . date('M. d, Y', strtotime($info['inception_date'])) . '</td>';
$html .= '<td>' . $info['div_freq'] . '</td>';
$html .= '</tr>';
}
$html .= '</tbody>';
$html .= '</table>';
$html .= '</div>';
?>