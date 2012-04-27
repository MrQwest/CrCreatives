var cc = cc || {
    'data': {
        'yellowswitch': ['Miss the yellow?','Ditch the yellow?']
    },
    'init': function() {
        this.setupNav();
        this.themeSwitcher();
        this.twitterLoader();
    },
    'setupNav': function() {
        $.root.find('ul.mainnav a:not([rel=external])').on('click',function() {
            $.scrollTo($('#'+this.href.split('#')[1]),500);
        });
    },
    'themeSwitcher': function() {
        $.root.find('*[data-switch]').each(function() {
            cc.addSwitchTo($(this));
        });
    },
    'addSwitchTo': function($el) {
        var switchType = $el.attr('data-switch');
        $el.append('<span class="' + switchType + '"><a href="#" title="' + cc.data[switchType][0] + '">' + cc.data[switchType][0] + '</a></span>');

        $el.on('click',function(event) {
            var background = $.root.find('div.anystretch');
            var backgroundVisible = background.css('display') == 'block';

            event.preventDefault();

 			background[backgroundVisible ? 'fadeOut' : 'fadeIn']('fast');
            $el.find('span a')[backgroundVisible ? 'addClass' : 'removeClass']('switched')
                .text(cc.data[switchType][backgroundVisible ? 1 : 0])
                .attr('title',cc.data[switchType][backgroundVisible ? 1 : 0])
        });
    },
    'twitterLoader': function() {
        this.getTweets();

        setInterval(function() {
            cc.getTweets();
        }, 300000);
    },
    'getTweets': function() {
        $.root.find('#tweetlist').load("tweetstream/cctweets.php");
    }
};

$(function() {
    $.root = $.root || $(document);
    cc.init();
});