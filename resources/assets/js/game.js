try {
    var game = {
        container: '.game-container',
        events: function () {
            self = this;

            //button game
            $(document).on('submit', '#game', function (e) {
                e.preventDefault();

                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    dataType: "json",
                    data: $(this).serialize()
                })
                    .done(function (data) {
                        $(self.container).html(data.view);
                        console.log(data);
                    })
                    .fail(function (data) {
                        console.log(data);
                    });
            });
        },
        init: function () {
            this.events();
        }
    };

    game.init();
} catch (e) {
}