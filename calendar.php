<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Календарь</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="calendar-container">
        <h1>Календар</h1>
        <?php
            function createCalendar($year) {
                $months = ["Січень", "Лютий", "Березень", "Квітень", "Травень", "Червень", "Липень", "Серпень", "Вересень", "Жовтень", "Листопад", "Грудень"];
                $days = ["Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Нд"];
                $holidays = [
                    1 => [1 => true],
                    3 => [8 => true],
                    5 => [1 => true, 8 => true],
                    6 => [28 => true],
                    7 => [15 => true],
                    8 => [24 => true],
                    10 => [1 => true],
                    12 => [25 => true]
                ];
                
                $calendarHTML = "";

                for ($month = 0; $month < 12; $month++) {
                    $calendarHTML .= "<table><caption>{$months[$month]}</caption><tr>";
                    
                    foreach ($days as $day) {
                        $calendarHTML .= "<th>$day</th>";
                    }
                    $calendarHTML .= "</tr>";

                    $date = mktime(0, 0, 0, $month + 1, 1, $year);
                    $dayOfWeek = (int)date('N', $date) - 1;

                    $calendarHTML .= "<tr>";
                    for ($i = 0; $i < $dayOfWeek; $i++) {
                        $calendarHTML .= "<td></td>";
                    }

                    while ((int)date('m', $date) - 1 === $month) {
                        $day = (int)date('j', $date);
                        $isHoliday = isset($holidays[$month + 1][$day]);

                        $calendarHTML .= "<td" . (($dayOfWeek >= 5 || $isHoliday) ? " class='specialDay'" : "") . ">$day</td>";
                        
                        if ($dayOfWeek == 6) {
                            $calendarHTML .= "</tr><tr>";
                        }
                        
                        $date = strtotime("+1 day", $date);
                        $dayOfWeek = (int)date('N', $date) - 1;
                    }

                    $calendarHTML .= "</tr></table>";
                }

                echo $calendarHTML;
            }

            createCalendar(2024);
        ?>
    </div>
</body>
</html>
