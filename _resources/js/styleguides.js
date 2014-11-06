$(function(){
	(function($){
		$.fn.affix.Constructor.prototype.checkPosition = function() {
			"use strict";
			if (!this.$element.is(':visible')) return

			var scrollHeight = $(document).height()
			var scrollTop    = this.$window.scrollTop()
			var position     = this.$element.offset()
			var offset       = this.options.offset
			var offsetTop    = offset.top
			var offsetBottom = offset.bottom

			if (typeof offset != 'object')         offsetBottom = offsetTop = offset
			if (typeof offsetTop == 'function')    offsetTop    = offset.top()
			if (typeof offsetBottom == 'function') offsetBottom = offset.bottom()
//+ this.unpin
			var affix = this.unpin   != null && (scrollTop  <= position.top) ? false :
						offsetTop    != null && (scrollTop <= offsetTop) ? 'top' :
						offsetBottom != null && (position.top + this.$element.outerHeight(true) >= scrollHeight - offsetBottom - 20) ? 'bottom' : false

		// console.log([scrollTop, offsetTop, scrollTop <= offsetTop])
			if (this.affixed === affix) return
			if (true || this.unpin) this.$element.css('top', '')

			this.affixed = affix
			this.unpin   = affix == 'bottom' ? position.top - scrollTop : null

			this.$element.removeClass('affix affix-top affix-bottom').addClass('affix' + (affix ? '-' + affix : ''))

			if (affix == 'bottom') {
			  this.$element.offset({ top: document.body.offsetHeight - offsetBottom - this.$element.outerHeight(true) })
			}
		}
	})(jQuery);
	var headers = $('#main-container h2');
	var section = $(self.location).attr('pathname').split("/")[1];
	var isCategory = ($(self.location).attr('pathname').split("/").length < 4 && $(self.location).attr('hostname') == 'its.uark.edu')
	$('.floater').addClass('loaded').addClass(section);
	if (headers.length > 1) {
		var $linklist = $('<ul class="pagelinks nav navlist">');
		headers.each(function(){
			var anchor = this.id;
			if (anchor) {
				 $linklist.append('<li><a href="#' + anchor + '">' + $(this).text() + '</a></li>');
			};
		});

		if (!isCategory && $linklist.find('li').length) {
			$('.floater:not(.news)')
				.prepend($linklist)
				.prepend('<p class="head">Sections</p>');
		}

		$('body').scrollspy({ target: '#affixed .floater' });
	};



	if (self.location == top.location) {
	setTimeout(function () {
		var elem = $('#affixed');
		elem.height(elem.height()); // explicitly set height so the affix plugin doesn't assume 0
        elem.affix({
         offset: {
			top: function () { return $('.breadcrumb + .row').offset().top ; },
			bottom: function () {
				this.bottom = 40 + $('footer').outerHeight(true) + $('#prefooter').outerHeight(true);
				return this.bottom;
			}
        }
      })
    }, 100);
	}
});


$(function() {
	/* Add GA tracking to files */
	$('a[href$=".pdf"], a[href$=".doc"], a[href$=".xls"], a[href$=".ppt"], a[href$=".rtf"]').click(function(){
			_gaq.push(['_trackEvent', 'downloads', this.href]);
			_gaq.push(['its._trackEvent', 'downloads', this.href]);
			});

	/* Track all cross-domain clicks */
	$('#main-container a[href], #mainnav a[href]').each(function(){
		var $this = $(this);
		var href = this.href;
		if(0 == href.indexOf('mailto')) {
			return true;
		}
		if (this.hostname == $(window.location).attr('hostname')) {
			return true;
		}
		if(-1 == $(window.location).attr('hostname').indexOf('omniupdate') && $this.is('#main-container a') && !$this.is('.btn, .uark-home, #sidebar a')) {
			var span = $('<span class="external"/>');
			 $this.wrapInner(span);
		}

		$this.on('click', function (){
			_gaq.push(['its._trackEvent', 'outgoing_links_' + $this.closest('[id]').attr('id'), this.href, $this.text()]);
		});
	});
	/* Add GA "print" event */
	try{
		(function() {
		var afterPrint = function() {
		_gaq.push(['its._trackEvent', 'Print', document.location.pathname]); //for classic GA
		};
		if (window.matchMedia) {
		var mediaQueryList = window.matchMedia('print');
		mediaQueryList.addListener(function(mql) {
		if (!mql.matches)
		afterPrint();
		});
		}
		window.onafterprint = afterPrint;
		}());
		} catch(e) {}
});


$.expr[':'].classStartsWith = function(el, i, selector) {
  var re = new RegExp("\\b" + selector[3]);
  return re.test(el.className);
}
$(function() {
	$(':classStartsWith("prepend-icon")', '#main-container, #mainnav').each(function () {
		var classes = $(this).attr('class').split(' ');
		var icoClass = '';
		$.each(classes, function (idx, value) {
			if (0 == value.indexOf('prepend-icon')) {
				icoClass = value.replace('prepend-', '');
				return;
			}
		});
		if (icoClass !== '') {
			$(this).prepend(' ').prepend($('<i/>').addClass(icoClass));
		}
	});

});

$(function(){
	/* 'Continue Reading' fadeout */
	if(document.referrer == '') return;

	/* don't trigger coming from the home page */
	if(/edu\/(?:index\.php)?$/.test(document.referrer)) return;

	/* don't trigger on other sites that use this javascript */
	if(/its.uark.edu/.test(document.referrer) !== true) return;

	var ref = document.referrer.replace('/index.php','');
	var loc = document.location.toString().replace('/index.php', '');
	if(ref.length > loc) return;
	if(loc.indexOf(ref) == 0) {
		$('p.lead:first-child').after($('<div class="hidden-print"><i class="icon-caret-down"></i> <span class="animated fadeOut">Continue reading</span></div>'));
	}
});

$(function(){
	/* Make headings on category pages clickable */
	$('.more-link').each(function(){
		var $this = $(this);
		var $heading = $this.closest('p').prev('h2,h3');
		$heading.wrapInner($('<a/>').attr('href', $this.attr('href')));
	});
});


$(function() {
	/* Make search box cover both its.uark.edu and techarticles.uark.edu */
	// site=ITS_ITServices
	$('#newRadios input:eq(0)').attr('name','site').attr('value','ITS_ITServices');
});
