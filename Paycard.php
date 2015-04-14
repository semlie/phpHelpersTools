<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace payments;

/**
 * Description of Paycard
 *
 * @author Admin
 */
class Paycard {
    //put your code here
    	function IsLowProfileCodeDealOneOK($lpc,$terminal,$username,$orderid)
	{
		$vars = array( 
		'TerminalNumber'=>$terminal, 
		'LowProfileCode'=>$lpc, 
		'UserName'=>$username 
		);
		
		# encode information
		$urlencoded = http_build_query($vars);
		$CR = curl_init();
		curl_setopt($CR, CURLOPT_URL, 'https://secure.cardcom.co.il/Interface/BillGoldGetLowProfileIndicator.aspx');
		curl_setopt($CR, CURLOPT_POST, 1);
		curl_setopt($CR, CURLOPT_FAILONERROR, true);
		curl_setopt($CR, CURLOPT_POSTFIELDS, $urlencoded );
		curl_setopt($CR, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($CR, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($CR, CURLOPT_FAILONERROR,true);
		$result = curl_exec( $CR );
		curl_close( $CR );
		parse_str($result);
		if (isset($DealResponse)&& $DealResponse == '0' && $ReturnValue==$orderid) #  Normal Deal
		{
			return '0'; // ok
		}
		else if (isset($SuspendedDealResponseCode)&& $SuspendedDealResponseCode== '0' && $ReturnValue==$orderid) #  Suspend Deal
		{
		      return '0'; // ok
		}
        
		return '1';
	} 

}
