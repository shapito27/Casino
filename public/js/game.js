try {
    var game = {
        container: '.game-container',
        form: 'form#game',
        refuseButton: '.refuse',
        convertButton: '.convert',
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

            //button refuse prize
            $(document).on('click', self.form +' ' + self.refuseButton, function (e) {
                e.preventDefault();

                $.ajax({
                    method: $(self.form).attr('method'),
                    url: $(self.form +' ' + self.refuseButton).data('url'),
                    dataType: "json",
                    data: $(self.form).serialize()
                })
                    .done(function (data) {
                        $(self.container).html(data.view);
                        console.log(data);
                    })
                    .fail(function (data) {
                        console.log(data);
                    });
            });

            //button convert prize
            $(document).on('click', self.form +' ' + self.convertButton, function (e) {
                e.preventDefault();

                $.ajax({
                    method: $(self.form).attr('method'),
                    url: $(self.form +' ' + self.convertButton).data('url'),
                    dataType: "json",
                    data: $(self.form).serialize()
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