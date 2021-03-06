## Установка
1. `git clone https://Shapito27@bitbucket.org/Shapito27/casino.git`
2. `bash configs1.sh`
3. Настройте доступ к БД в /.env

    DB_CONNECTION=mysql

    DB_HOST=127.0.0.1

    DB_PORT=3306

    DB_DATABASE=homestead

    DB_USERNAME=homestead

    DB_PASSWORD=secret
    
4. `bash configs2.sh`

## Запуск теста
`php vendor/bin/phpunit` 

## Запуск команды, которая будет отправлять денежные призы на счета пользователей
`php artisan casino:sendMoney` 


## Запуск веб-сервера 
`php artisan serve`

## Вход
Для админа:

**логин**:  example@test.ru

**пароль**: 3sdf980sd8fsdf

Игрокам, надо регистрироваться на сайте.
## Описание для непрограммиста

Схема БД http://prntscr.com/lmx8ni

Имеются 3 типа призов. В не зависимости от типа приза, происходят одинаковые события: приз был на счету системы, после выйгрыша приз переходит на счет игрока. В программе можно реализовать у каждого пользователя 3 счета под каждый тип призов.

Передача с одного аккаунта на другой хорошо ложится на бухгалтерскую теорию. Проводки, двойная запись, журнал проводок. Если так реализовать, получится хороший контроль за движением всех призов с аккаунта на аккаунт. Самая простая и эффективная реализация получилось такой:

Таблица operations с проводками, в которой видно с какого аккаунт на какой перешел приз. Например, если пользователь выйграл денежный приз, то к нему на денежный аккаунт приходит выйгранная сумма с системного аккаунт. Аналогично и с другими типами призов. Исключение составляем физический приз. При выйгрыше в проводку записывается не сумма денег или бонусов, а id приза.

Таблицa accountBalanceHistory не только для история баланса и последнее добавленное значение для аккаунта есть актуальный баланс. Обновляется после каждого добавления проводки в Operations.

Таблицa accounts хранит все аккаунт пользователей с указанием типа.

Таблицa subjects хранит добавленные администратором физические предметы - призы.

Таблицa prize_intervals хранит интервалы, которые ограничивают размер приза для денежного и бонусного приза.

Таблица users хранит всех зарегистрированных пользователей, а таблицы roles, role_user, permissions, permission_role необходимы для организации уровней доступа.

## Дополнительная информация

Чтобы разделить логику для разных типов призов использовал паттерн стратегии. 
Делегировал логику работы с каждым типом аккаунта соответствующему классу. Т.е. если приз деньги, то отвечал за перевод соответствующий класс MoneyAccount, если это приз физический предмет, то SubjectAccount

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
