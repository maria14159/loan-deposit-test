<?php

class LegalForm extends Form
{
    public function __construct()
    {
        $arr = [
            new TextField(1, 'ФИО руководителя', 'fio', 'Фамилия Имя Отчество'),
            new TextField(1, 'ИНН руководителя', 'Inn', 'ИНН'),
            new TextField(1, 'Наименование организации', 'orgName', 'Наименование'),
            new TextField(1, 'ИНН организации', 'orgInn', 'ИНН'),
            new TextField(1, 'ОГРН', 'ogrn', 'ОГРН'),
            new TextField(1, 'КПП', 'kpp', 'КПП'),
            new TextField(1, 'Адрес организации', 'address', 'Адрес'),

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
            and isset($form["orgName"])
            and isset($form["ogrn"])
            and isset($form["kpp"])
            and isset($form["address"])) {


            $statement = $pdo->prepare('insert into organization (name, address, inn, ogrn, kpp) values(:name, :address, :inn, :ogrn, :kpp)');
            $statement->execute([
                ':name' => $form["orgName"],
                ':address' => $form['address'],
                ':inn' => $form['Inn'],
                ':ogrn' => $form['ogrn'],
                ':kpp' => $form['kpp'],
            ]);


            $select = $pdo->prepare('select id from organization where inn = :inn and ogrn = :ogrn and kpp = :kpp');
            $select->execute([
                ':inn' => $form["Inn"],
                ':ogrn' => $form['ogrn'],
                ':kpp' => $form['kpp']
            ]);

            $orgId = $select->fetch()[0];

            $statement = $pdo->prepare('insert into person (fio, inn, organization_id) values(:fio, :inn, :organization_id)');
            $statement->execute([
                ':fio' => $form["fio"],
                ':inn' => $form['Inn'],
                ':organization_id' => intval($orgId)
            ]);

            $select = $pdo->prepare('select id from person where fio = :fio and inn = :inn and organization_id = :organization_id');
            $select->execute([
                ':fio' => $form["fio"],
                ':inn' => $form['Inn'],
                ':organization_id' => intval($orgId)
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