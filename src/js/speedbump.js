import ally from 'ally.js';

(function() {
	var speedbump = document.getElementById('speedbump');
	var disabledHandle;
	var tabHandle;
	var keyHandle;
	var hiddenHandle;
	var siteDomains = [window.location.hostname.split('.').slice(-2).join('.')];
	function waitForWhitelist() {
		if (typeof(window.speedbumpWhitelist) !== 'undefined') {
			if (window.speedbumpWhitelist.length > 0) {
				for (var a = 0; a < window.speedbumpWhitelist.length;a++) {
					var location = document.createElement('a');
					location.href = window.speedbumpWhitelist[a];
					siteDomains.push(location.hostname.split('.').slice(-2).join('.'));
				}
			}
		} else {
			setTimeout(waitForWhitelist, 250);
		}
	}
	waitForWhitelist();
	function displaySpeedbump(url, lastFocus, successCallback) {
		function closeSpeedbump() {
			tabHandle.disengage();
			disabledHandle.disengage();
			keyHandle.disengage();
			hiddenHandle.disengage();
			speedbump.setAttribute('aria-hidden', 'true');
			speedbump.style.display = 'none';
			lastFocus.focus();
		}
		speedbump.setAttribute('aria-hidden', 'false');
		speedbump.style.display = 'block';
		disabledHandle = ally.maintain.disabled({
			filter: speedbump
		});
		tabHandle = ally.maintain.tabFocus({
			context: speedbump
		});
		keyHandle = ally.when.key({
			escape: closeSpeedbump
		});
		hiddenHandle = ally.maintain.hidden({
			filter: speedbump
		});
		var accept = speedbump.querySelector('.speedbump--accept');
		var close = speedbump.querySelector('.speedbump--close');
		accept.focus();
		close.addEventListener('click', function(e) {
			closeSpeedbump();
		});
		accept.addEventListener('click', function(e) {
			successCallback();
		});
	}
	var clickListener = function(event) {
		var url = event.target.href;
		var domain = event.target.hostname.split('.').slice(-2).join('.');

		if (siteDomains.indexOf(domain) < 0 || event.target.classList.contains('require-speedbump') == true) {
			event.preventDefault();
			displaySpeedbump(url, event.target, function () {
				this.target.removeEventListener('click', clickListener);
				this.target.click();
			}.bind(event));
		}
	};
	var externalLinks = document.getElementsByTagName('a');
	for (var i=0; i<externalLinks.length; i++) {
		externalLinks[i].addEventListener('click', clickListener);
	}
})();
