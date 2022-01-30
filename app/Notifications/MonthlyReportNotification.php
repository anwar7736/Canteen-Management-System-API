<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MonthlyReportNotification extends Notification implements ShouldQueue
{
    use Queueable;
    
    public $name = '';    
    public $month = '';
    public $year = '';
    public $total_lunch = '';
    public $total_lunch_cost = '';
    public $total_dinner = '';
    public $total_dinner_cost = '';
    public $total_meal = '';
    public $total_meal_cost = '';
    public $total_payment = '';
    public $total_due = '';


    public function __construct(
                                $name, $month, $year, 
                                $total_lunch, $total_lunch_cost, 
                                $total_dinner, $total_dinner_cost,
                                $total_meal, $total_meal_cost, 
                                $total_payment, $total_due
                                )
    {
            $this->name = $name;            
            $this->month = $month;
            $this->year = $year;
            $this->total_lunch = $total_lunch;
            $this->total_lunch_cost = $total_lunch_cost;
            $this->total_dinner = $total_dinner;
            $this->total_dinner_cost = $total_dinner_cost;
            $this->total_meal = $total_meal;
            $this->total_meal_cost = $total_meal_cost;
            $this->total_payment  = $total_payment;
            $this->total_due = $total_due;

    }

    public function via($notifiable)
    {

        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $name = $this->name;         
        $month = $this->month;
        $year = $this->year;
        $total_lunch = $this->total_lunch;
        $total_lunch_cost = $this->total_lunch_cost;
        $total_dinner = $this->total_dinner;
        $total_dinner_cost = $this->total_dinner_cost;
        $total_meal = $this->total_meal;
        $total_meal_cost  = $this->total_meal_cost;
        $total_payment  = $this->total_payment;
        $total_due = $this->total_due;

        return (new MailMessage)->view('notifications.monthly_statement', compact(
            'name', 'month', 'year',
            'total_lunch', 'total_lunch_cost',
            'total_dinner', 'total_dinner_cost',
            'total_meal', 'total_meal_cost',
            'total_payment', 'total_due'
        ));
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
