function init() {
      var shown = true
      var $text = options.showText

      var $graybar = $('<div>').addClass(
        'password-meter progress rounded-0 position-absolute'
      )
      $graybar.append(`<div class="row position-absolute w-100 m-0">
        <div class="col-3 border-left border-right border-white"></div>
        <div class="col-3 border-left border-right border-white"></div>
        <div class="col-3 border-left border-right border-white"></div>
        <div class="col-3 border-left border-right border-white"></div>
      </div>`)
      var $colorbar = $('<div>').attr({
        class: 'progress-bar',
        role: 'progressbar',
        'aria-valuenow': '0',
        'aria-valuemin': '0',
        'aria-valuemax': '100',
      })
      var $insert = $('<div>').append($graybar.append($colorbar))

      if (options.showText) {
        $text = $('<small>')
          .addClass('form-text text-muted')
          .html(options.enterPass)
        $insert.prepend($text)
      }

      $object.after($insert)

      $object.keyup(function() {
        var score = calculateScore($object.val())
        $object.trigger('password.score', [score])
        var perc = score < 0 ? 0 : score
        $colorbar.removeClass(function(index, className) {
          return (className.match(/(^|\s)bg-\S+/g) || []).join(' ')
        })
        $colorbar.addClass('bg-' + scoreColor(score))
        $colorbar.css({
          width: perc + '%',
        })
        $colorbar.attr('aria-valuenow', perc)

        if (options.showText) {
          var text = scoreText(score)
          if (!$object.val().length && score <= 0) {
            text = options.enterPass
          }

          if (
            $text.html() !==
            $('<div>')
              .html(text)
              .html()
          ) {
            $text.html(text)
            $text.removeClass(function(index, className) {
              return (className.match(/(^|\s)text-\S+/g) || []).join(' ')
            })
            $text.addClass('text-' + scoreColor(score))
            $object.trigger('password.text', [text, score])
          }
        }
      })

      return this
    }