## Установка
1. `git clone git@bitbucket.org:Shapito27/casino.git`
2. Настройка доступа к БД в /.env

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=homestead

DB_USERNAME=homestead

DB_PASSWORD=secret

## Вход
Для админа:

**логин**:  example@test.ru

**пароль**: 3sdf980sd8fsdf

Игрокам, надо регистрироваться на сайте.
## Описание
Попытался все счета (денежный, бонусный и счета с "физ. предметами") реализовать на основе бухгалтерской теории. Т.е. у пользователя есть 3 счета имеющие разный тип. Есть таблица Operations с проводками, которая объединяет в себе двойную запись, проводки и собственно журнал проводок.

Для примера, каждый выйгрыш это проводка: из систимного аккаунта выйгрыш переводится на аккаунт игрока.
Баланс хранится в отдельной таблице AccountBalanceHistory. После каждой проводки идет обновление балансов: системного и игрока. Обновление баланса для аккаунта представляет собой новую запись в таблице с прявязкой к аккаунту. Последняя запись по аккаунту есть актуальный баланс.

Для проверки, что всё в системе с деньгами на аккаунтах идет корректно, можно реализовать проверку актуально баланса. Сплюсовать все приходы и вычесть все расходы на основе данных из таблицы Operation и сравнить с балансом.

При создании приложения создается системный аккаунт администратора. Там можно указывать ограничения для выйгрыша. Интервал размера выйгрыша. Видеть сколько денег, бонусов и предметов выйграли игроки.

Все пользователи, которые будут регистрироваться на сайте получат роль user и у них будет возможность играть в игру.

Чтобы разделить логику для разных типов призов использовал паттер стратегии. 
Делегировал логику работы с каждым типом аккаунта соответствующему классу. Т.е. если приз деньги, то отвечал за перевод соответствующий класс MoneyAccountType, если это приз физический предмет, то SubjectAccountType и т.п.

## Проект
/app/Console/Commands  - консольные комманды

/app/Contracts  - интерфейсы

/app/Exceptions  - исключения

/app/Http/Controllers/Admin  - контроллеры административной части

/app/Http/Controllers/User  - контроллеры пользовательской части

/app/Jobs  - класс  для очереди

/app/Models  - модели

/app/Services  - классы слоя логики приложения

/routes/web.php  - роутинг приложения

## Прототип
Вход http://prntscr.com/lmvcg7

Регистрация http://prntscr.com/lmvcut

Первая страницы игры http://prntscr.com/lmvdef

Выйгрыш https://prnt.sc/lmve5d

Отказ от приза https://prnt.sc/lmvef2

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
