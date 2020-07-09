<?php
	$html .= '<div class="div_experienced_profile card" >';
	$html .= '<div class="card-body" >';

	$html .= '<h3>Advisor/Firm Profile</h3> <pre style="font-size:0.7em;" >[Last Edited/Updated on ' . date('m/d/Y', strtotime($result[0]->exp_date_updated)) . ']</pre>';

	$html .= '<div class="row pb-2 border-bottom" >';
	$html .= '<div class="col-md-4 text-right" >' . (!empty($result[0]->exp_headshot) && file_exists($_SERVER['DOCUMENT_ROOT'] . '/images/' . $result[0]->user_id . '/' . $result[0]->exp_headshot) ? '<img src="/images/' . $result[0]->user_id . '/' . $result[0]->exp_headshot . '" />' : '<i class="fas fa-user" style="font-size:5em;" ></i>') . '</div>';
	$html .= '<div class="col-md-8" >' . $result[0]->exp_firstname . ' ' . $result[0]->exp_lastname . '<br />' . $result[0]->exp_title . ' at ' . $result[0]->exp_firm . '</div>';	
	$html .= '</div>';

	$html .= '<div class="row mt-2 pb-2 border-bottom" >';
	$html .= '<div class="col-md-4 text-right" >' . (!empty($result[0]->exp_upload) && file_exists($_SERVER['DOCUMENT_ROOT'] . '/images/' . $result[0]->user_id . '/' . $result[0]->exp_upload) ? '<img src="/images/' . $result[0]->user_id . '/' . $result[0]->exp_upload . '" />' : '<i class="fas fa-user" style="font-size:5em;" ></i>') . '</div>';
	$html .= '<div class="col-md-8" >Work: ' . $result[0]->exp_work_phone . ' - <a href="mailto:' . $result[0]->exp_work_email . '" >' . $result[0]->exp_work_email . '</a><br />' . $result[0]->exp_work_street . ', ' . $result[0]->exp_work_suite . ', ' . $result[0]->exp_work_city . ', ' . $result[0]->exp_work_state . ', ' . $result[0]->exp_work_zipcode . ', ' . $result[0]->exp_work_country . '<br /><a href="https://' . $result[0]->exp_company_web . '" target="_blank" >' . $result[0]->exp_company_web . '</a></div>';	
	$html .= '</div>';	

	$html .= '<div class="row mt-2 pb-2 border-bottom" >';
	$html .= '<div class="col-md-4 text-right" ><i class="fab fa-linkedin" style="font-size:3em;" ></i></div>';
	$html .= '<div class="col-md-8" >' . '<a href="' . $result[0]->exp_linked . '" target="_blank" >' . $result[0]->exp_linked . '</a></div>';	
	$html .= '</div>';	
	
	$html .= '<div class="row mt-2 pb-2 border-bottom" >';
	$html .= '<div class="col-md-4 text-right" ><i class="fab fa-twitter-square" style="font-size:3em;" ></i></div>';
	$html .= '<div class="col-md-8" >' . '<a href="https://twitter.com/' . $result[0]->exp_twitter . '" target="_blank" >' . $result[0]->exp_twitter . '</a></div>';	
	$html .= '</div>';
	
	/*$html .= '<div class="row mt-2 pb-2 border-bottom" >';
	$html .= '<div class="col-md-4" ></div>';
	$html .= '<div class="col-md-8" ><a href="#" class="a_more_profile" >CLICK MORE</a></div>';	
	$html .= '</div>';*/
	
	$html .= '<div class="div_more_profile" >';
	
	$html .= '<div class="row mt-2" >';
	$html .= '<div class="col-md-12" >Started in ' . $result[0]->exp_year_started . ', using ' . $result[0]->exp_perc_aum . ' since ' . $result[0]->exp_year_entered . '</div>';	
	$html .= '</div>';	

	$getAumOptions = explode(',', substr($result[0]->exp_per_aum_options, 0, -1));
	$html .= '<div class="row mt-2 pb-2 border-bottom" >';
	foreach($getAumOptions As $aumOp) {
		$aumLabOpt = explode(':', $aumOp);
		$html .= '<div class="col-md-12" >' . $aumLabOpt[1] . ' of my business is focused on ' . $aumLabOpt[0] . '</div>';
	}
	$html .= '</div>';		
	
	$getCustOptions = explode(',', substr($result[0]->exp_cust_options, 0, -1));
	$html .= '<div class="row mt-2 pb-2 border-bottom" >';
	$html .= '<div class="col-md-12" ><strong>Custodian(s):</strong> ';		
	foreach($getCustOptions As $custOp) {
		$custLabOpt = explode(':', $custOp);
		$html .= $custLabOpt[0] . ($custLabOpt[0] == 'Other' ? '(' . $result[0]->exp_cust_other . ')' : '') . ',';
	}
	$html = substr($html, 0, -1);
	$html .= '</div>';
	$html .= '</div>';		
	
	$html .= '<div class="row mt-2 pb-2 border-bottom" >';
	$html .= '<div class="col-md-12" ><strong>Firm/Advisor $AUM:</strong> $' . $result[0]->exp_ad_aum . 'MM as of ' . date('m/d/Y', strtotime($result[0]->exp_aum_reported)) . '</div>';	
	$html .= '</div>';		
	
	$html .= '<div class="row mt-2 pb-2 border-bottom" >';
	$html .= '<div class="col-md-12" ><strong>Firm CRD #</strong> <a href="https://www.adviserinfo.sec.gov/Firm/' . $result[0]->exp_firm_crd . '" target="_blank" >' . $result[0]->exp_crd . '</a></div>';	
	$html .= '</div>';
	
	$html .= '<div class="row mt-2 pb-2 border-bottom" >';
	$html .= '<div class="col-md-12" ><strong>Individual CRD #</strong> <a href="https://www.adviserinfo.sec.gov/Individual/' . $result[0]->exp_crd . '" target="_blank" >' . $result[0]->exp_firm_crd . '</a></div>';	
	$html .= '</div>';
	
	$html .= '<div class="row mt-2" >';
	$html .= '<div class="col-md-12" ><strong>Hoppy / Special Interest:</strong> ' . $result[0]->exp_hobby . '</div>';	
	$html .= '</div>';		

	$html .= '</div>';

	$html .= '</div>';	
	$html .= '</div>';
?>