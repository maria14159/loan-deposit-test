<?php

class PhysicalForm extends Form
{

    public function __construct()
    {
        $arr = [
            new TextField(1, 'ФИО', 'fio', 'Фамилия Имя Отчество'),
            new TextField(1, 'ИНН', 'Inn', 'ИНН'),
            new DateField(1, 'Дата рождения', 'birthDate'),
            new PassportField(),

            new DateField(2, 'Дата открытия', 'loanOpenDate'),
            new DateField(2, 'Дата закрытия', 'loanCloseDate'),
            new TextField(2, 'Сумма', 'sum', '100000'),

            new DateField(3, 'Дата открытия', 'depositOpenDate'),
            new DateField(3, 'Дата закрытия', 'depositCloseDate'),
            new TextField(3, 'Срок (в месяцах)', 'time', '12'),
            new TextField(3, 'Ставка %', 'rate', '1'),
            new CapitalizationField()
        ];


        parent::__construct($arr);
    }

    public function endpoint($pdo, $form) {
        if (isset($form["fio"])
            and isset($form["Inn"])
            and isset($form["birthDate"])
            and isset($form["passportSeries"])
            and isset($form["passportNumber"])
            and isset($form["passportDate"])) {


            $statement = $pdo->prepare('insert into passport (series, number, date) values(:series, :number, :date)');
            $statement->execute([
                ':series' => $form["passportSeries"],
                ':number' => $form['passportNumber'],
                ':date' => $form['passportDate']
            ]);


            $select = $pdo->prepare('select id from passport where series = :series and number = :number and date = :date');
            $select->execute([
                ':series' => $form["passportSeries"],
                ':number' => $form['passportNumber'],
                ':date' => $form['passportDate']
            ]);

            $passportId = $select->fetch()[0];

            $statement = $pdo->prepare('insert into person (fio, inn, birth_date, passport_id) values(:fio, :inn, :birth_date, :passport_id)');
            $statement->execute([
                ':fio' => $form["fio"],
                ':inn' => $form['Inn'],
                ':birth_date' => $form['birthDate'],
                ':passport_id' => intval($passportId)
            ]);

            $select = $pdo->prepare('select id from person where fio = :fio and inn = :inn and passport_id = :passport_id');
            $select->execute([
                ':fio' => $form["fio"],
                ':inn' => $form['Inn'],
                ':passport_id' => intval($passportId)
            ]);

            $personId = $select->fetch()[0];

            if (isset($form["loanOpenDate"])
                and isset($form["loanCloseDate"])
                and isset($form["sum"])) {

                $statement = $pdo->prepare('insert into loan (person_id, open_date, close_date, sum) values(:person_id, :open_date, :close_date, :sum)');
                $statement->execute([
                    ':person_id' => intval($personId),
                    ':open_date' => $form['loanOpenDate'],
                    ':close_date' => $form['loanCloseDate'],
                    ':sum' => $form["sum"]
                ]);
            }

            if (isset($form["depositOpenDate"])
                and isset($form["depositCloseDate"])
                and isset($form["time"])
                and isset($form["rate"])
                and isset($form["capitalization"])
            ) {

                $statement = $pdo->prepare('insert into deposit (person_id, open_date, close_date, time, rate, capitalization) values(:person_id, :open_date, :close_date, :time, :rate, :capitalization)');
                $statement->execute([
                    ':person_id' => intval($personId),
                    ':open_date' => $form['depositOpenDate'],
                    ':close_date' => $form['depositCloseDate'],
                    ':time' => $form["time"],
                    ':rate' => $form["rate"],
                    ':capitalization' => $form["capitalization"],
                ]);

            }

        }
    }

}