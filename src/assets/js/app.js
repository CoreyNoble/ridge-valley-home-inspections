import $ from 'jquery';
import whatInput from 'what-input';

window.$ = $;

import Foundation from 'foundation-sites';
// If you want to pick and choose which modules to include, comment out the above and uncomment
// the line below
//import './lib/foundation-explicit-pieces';


$(document).foundation();

// Contact Validation
function getParameterByName(name, url) {
  if (!url) url = window.location.href;
  name = name.replace(/[\[\]]/g, '\\$&');
  var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

var dir = getParameterByName('captcha');

$(document).ready(function() {
  if (dir == 'none') {
    $('#captcha-none').removeClass('hide');
    $('#captcha-none').focus();
    $('#captcha-none').attr('aria-hidden', 'false');
  }
  if (dir == 'failed') {
    $('#captcha-failed').removeClass('hide');
    $('#captcha-failed').focus();
    $('#captcha-failed').attr('aria-hidden', 'false');
  } else {
    return;
  }
});