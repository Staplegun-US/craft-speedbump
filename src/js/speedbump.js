import ally from 'ally.js';
(function() {
	var speedbump = document.getElementById('speedbump');
	var disabledHandle;
	var tabHandle;
	var keyHandle;
	var hiddenHandle;
	var onlyUseClass;
	var siteDomains = [window.location.hostname.split('.').slice(-2).join('.')];
	function waitForSettings() {
		if (typeof(window.speedbumpSettings) !== 'undefined') {
			var whitelist = window.speedbumpSettings['whitelist'];
			if (whitelist.length > 0) {
				for (var a = 0; a < whitelist.length;a++) {
					var location = document.createElement('a');
					location.href = whitelist[a];
					siteDomains.push(location.hostname.split('.').slice(-2).join('.'));
				}
			}
			if ('useClassOnly' in window.speedbumpSettings) {
				onlyUseClass = window.speedbumpSettings['useClassOnly'];
			}
		} else {
			setTimeout(waitForSettings, 250);
		}
	}
	waitForSettings();
	function displaySpeedbump(url, lastFocus, successCallback) {
		var accept = speedbump.querySelector('.speedbump--accept');
		var close = speedbump.querySelector('.speedbump--close');
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
		accept.focus();
		function clickOpen(e) {
			successCallback();
			closeSpeedbump();
		}
		function clickClose(e) {
			closeSpeedbump();
			accept.removeEventListener('click', clickOpen);
			close.removeEventListener('click', clickClose);
		}
		accept.addEventListener('click', clickOpen);
		close.addEventListener('click', clickClose);
	}
	function clickListener(event) {
		var matchesFn;
		['matches','webkitMatchesSelector','mozMatchesSelector','msMatchesSelector','oMatchesSelector'].some(function(fn) {
			if (typeof document.body[fn] == 'function') {
				matchesFn = fn;
				return true;
			}
			return false;
		})

		var anchor = event.target;

		if(anchor && !anchor[matchesFn]('a')) {
			var parent = anchor;
			while (!anchor[matchesFn]('a')) {
				parent = parent.parentElement;
				if (parent && parent[matchesFn]('a')) {
					anchor = parent;
				}
			}
		}

		var url = anchor.href;
		var domain = anchor.hostname.split('.').slice(-2).join('.');

		if ((!onlyUseClass && siteDomains.indexOf(domain) < 0) ||
		(onlyUseClass && anchor.classList.contains('require-speedbump') == true)) {
			event.preventDefault();
			displaySpeedbump(url, event.target, function () {
				anchor.removeEventListener('click', clickListener);
				anchor.click();
			}.bind(anchor));
		}
	};
	var externalLinks = document.getElementsByTagName('a');
	for (var i=0; i<externalLinks.length; i++) {
		externalLinks[i].addEventListener('click', clickListener);
	}
})();
