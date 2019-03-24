import $ from 'jquery';
import whatInput from 'what-input';

window.$ = $;

import Foundation from 'foundation-sites';
// If you want to pick and choose which modules to include, comment out the above and uncomment
// the line below
//import './lib/foundation-explicit-pieces';


$(document).foundation();

// Menu
$(document).ready(function(){
	var count1 = 1;
	var count2 = 1;
	$('#nav-icon1').click(function(){
		if (count1 === 1){
			$('#nav-icon1').addClass('open');
		} else if (count1 === 2){
			$('#nav-icon1').removeClass('open');
		}
	});
	$('#nav-icon2').click(function(){
		if (count2 === 1){
			$('#nav-icon2').addClass('open');
		} else if (count2 === 2){
			$('#nav-icon2').removeClass('open');
		}
	});
});