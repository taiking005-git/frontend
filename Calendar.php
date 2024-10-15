<?php

class Calendar
{
    private $active_year, $active_month, $active_day;
    private $events = [];
    private $months = ["January", "Feburary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    public function __construct($date = null)
    {
        $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
        $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
        $this->active_day = $date != null ? date('d', strtotime($date)) : date('d');
    }

    public function add_event($txt, $date, $days = 1, $status = '')
    {
        $status = $status ? ' ' . $status : $status;
        $this->events[] = [$txt, $date, $days, $status];
    }

    public function next_month()
    {
        $this->active_month++;
        if ($this->active_month > 12) {
            $this->active_month = 1;
            $this->active_year++;
        }
        $this->renderCalendar();
    }

    public function prev_month()
    {
        $this->active_month--;
        if ($this->active_month < 1) {
            $this->active_month = 12;
            $this->active_year--;
        }
        // $html = '<div class="calendar__container">';
        $this->renderCalendar();
    }

    

    public function renderCalendar()
    {
        $num_days = date('t', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year));
        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year)));
        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
        $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->active_month . '-1')), $days);
        $html = '<div class="calendar__container">';
        $html .= '<div class="d-flex justify-content-between align-items-center mb-4">';
        $html .= ' <select class="form-select form-select-sm w-auto" name="" id="">
                    <option value="0">' . $this->months[$this->active_month - 1] . ' ' . $this->active_year . '</option>
                    <option value="1">Feburary 2024</option>
                    <option value="2">March</option>
                    <option value="3">April</option>
                    <option value="4">May</option>
                    <option value="5">June</option>
                    <option value="6">July</option>
                    <option value="7">August</option>
                    <option value="8">September</option>
                    <option value="9">October</option>
                    <option value="10">November</option>
                    <option value="11">December</option>
                  </select>';
        $html .= '<div class="gap-4 d-flex buttons-icon">
                    <i class="bi bi-chevron-left prev"  id="prev"></i>
                    <i class="bi bi-chevron-right next" id="next"></i>
                  </div>
                </div>';
        $html .= '<div class="body">
                  <ul class="weekdays">';
        foreach ($days as $day) {
            $html .= '
                            <li>' . $day . '</li>';
        }
        $html .= '</ul>';
        $html .= '<ul class="dates">';
        for ($i = $first_day_of_week; $i > 0; $i--) {
            $html .=
                '<button type="button" disabled>'
                . ($num_days_last_month - $i + 1)  .
                '</button>';
        }
        for ($i = 1; $i <= $num_days; $i++) {
            $selected = '';
            $today = '';
            $status = '';

            // identify booked date in the events array
            foreach ($this->events as $event) {
                for ($d = 0; $d <= ($event[2] - 1); $d++) {
                    if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                        $status = $event[3];
                    }
                }
            }
            if ($i == $this->active_day && strtotime($this->active_month) == date('m')) {
                $today = ' today';
            }
            $html .= '<button type="button" class="day_num ' . $today . $selected . $status  . '">';
            $html .= '<span>' . $i . '</span>';
            // foreach ($this->events as $event) {
            //     for ($d = 0; $d <= ($event[2] - 1); $d++) {
            //         if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
            //             $html .= '<div class="event' . $event[3] . '">';
            //             $html .= $event[0];
            //             $html .= '</div>';
            //         }
            //     }
            // }
            $html .= '</button>';
        }
        for ($i = 1; $i <= (42 - $num_days - max($first_day_of_week, 0)); $i++) {
            $html .= '
                <button type="button" disabled class="day_num ignore">
                    ' . $i . '
                </button>
            ';
        }
        $html    .= '</ul></div>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
    // public function __toString()
    // {
    //     $num_days = date('t', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year));
    //     $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year)));
    //     $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
    //     $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->active_month . '-1')), $days);
    //     $html = '<div class="calendar__container">';
    //     $html .= '<div class="d-flex justify-content-between align-items-center mb-4">';
    //     $html .= ' <select class="form-select form-select-sm w-auto" name="" id="">
    //                 <option value="0">'. $this->months[$this->active_month -1] . ' ' . $this->active_year .'</option>
    //                 <option value="1">Feburary 2024</option>
    //                 <option value="2">March</option>
    //                 <option value="3">April</option>
    //                 <option value="4">May</option>
    //                 <option value="5">June</option>
    //                 <option value="6">July</option>
    //                 <option value="7">August</option>
    //                 <option value="8">September</option>
    //                 <option value="9">October</option>
    //                 <option value="10">November</option>
    //                 <option value="11">December</option>
    //               </select>';
    //     $html .= '<div class="gap-4 d-flex buttons-icon">
    //                 <i class="bi bi-chevron-left prev"  id="prev"></i>
    //                 <i class="bi bi-chevron-right next" id="next"></i>
    //               </div>
    //             </div>';
    //     $html .= '<div class="body">
    //               <ul class="weekdays">';
    //     foreach ($days as $day) {
    //         $html .= '
    //                         <li>' . $day . '</li>';
    //     }
    //     $html .= '</ul>';
    //     $html .= '<ul class="dates">';
    //     for ($i = $first_day_of_week; $i > 0; $i--) {
    //         $html .=
    //             '<button type="button" disabled>'
    //             . ($num_days_last_month - $i + 1)  .
    //             '</button>';
    //     }
    //     for ($i = 1; $i <= $num_days; $i++) {
    //         $selected = '';
    //         $today = '';
    //         $status = '';
    //         if ($i == $this->active_day) {
    //             $today = ' today';
    //         }
    //         // identify booked date in the events array
    //         foreach ($this->events as $event) {
    //             for ($d = 0; $d <= ($event[2] - 1); $d++) {
    //                 if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
    //                     $status = $event[3];
    //                 }
    //             }
    //         }

    //         $html .= '<button type="button" class="day_num ' . $today . $selected . $status  . '">';
    //         $html .= '<span>' . $i . '</span>';
    //         // foreach ($this->events as $event) {
    //         //     for ($d = 0; $d <= ($event[2] - 1); $d++) {
    //         //         if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
    //         //             $html .= '<div class="event' . $event[3] . '">';
    //         //             $html .= $event[0];
    //         //             $html .= '</div>';
    //         //         }
    //         //     }
    //         // }
    //         $html .= '</button>';
    //     }
    //     for ($i = 1; $i <= (42 - $num_days - max($first_day_of_week, 0)); $i++) {
    //         $html .= '
    //             <button type="button" disabled class="day_num ignore">
    //                 ' . $i . '
    //             </button>
    //         ';
    //     }
    //     $html    .= '</ul></div>';
    //     $html .= '</div>';
    //     $html .= '</div>';
    //     return $html;
    // }
}
