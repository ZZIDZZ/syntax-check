function addTop($, top) {
    console.log('addTop', top);

    $(top.join(',')).each(function (i, obj) {
      //$(obj).append(' <a href="#" style="display:none;font-size: 12px;color: #333;">Top</a>');
      $(obj).prepend(['<div style="position: relative;width: 1px;">',
        '<a href="javascript:;" style="position:absolute;width:1.2em;left:-1.2em;font-size:0.8em;display:inline-block;visibility:hidden;color:#333;text-align:left;text-decoration: none;">',
        '&#10022;</a>',
        '</div>'].join(''));

      var $prefix = $(this).find(':first').find(':first');
      //var $top = $(this).find('a:last');
      //console.log($prefix, $top);
      var rawCol = $(obj).css('background-color');
      $(obj).mouseover(
        function () {
          $prefix.css('height', $(this).css('height'));
          $prefix.css('line-height', $(this).css('line-height'));
          $prefix.css('visibility', 'visible');
          $(this).css('background-color', '#FFF8D7');
        }).mouseout(function () {
          $prefix.css('visibility', 'hidden');
          $(this).css('background-color', rawCol);
        });
    });
  }