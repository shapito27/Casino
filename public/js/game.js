try {
    var game = {
        gameContainer: '.game-container',
        accountBalanceContainer: '.account-balance-container',
        withdrawContainer: '.withdraw-container',
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
                        self.updateContainer(data.view);
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
                        self.updateContainer(data.view);
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
                        self.updateContainer(data.view);
                        console.log(data);
                    })
                    .fail(function (data) {
                        console.log(data);
                    });
            });

            //button withdraw
            $(document).on('submit', '#withdraw', function (e) {
                e.preventDefault();

                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    dataType: "json",
                    data: $(this).serialize()
                })
                    .done(function (data) {
                        $(self.withdrawContainer).html(data);
                        self.updateBalance();
                        console.log(data);
                    })
                    .fail(function (data) {
                        console.log(data);
                    });
            });
        },
        updateBalance: function() {
            self = this;

            $.ajax({
                method: 'post',
                url: $(self.accountBalanceContainer).data('url'),
                dataType: "json",
                data: {'_token': $(self.accountBalanceContainer).data('crsf')}
            })
                .done(function (data) {
                    $(self.accountBalanceContainer).html(data[0]);
                    console.log(data);
                })
                .fail(function (data) {
                    console.log(data);
                });
        },
        updateContainer: function(data) {
            self = this;

            $(self.gameContainer).html(data);
            self.updateBalance();
        },
        init: function () {
            this.events();
        }
    };

    game.init();
} catch (e) {
}