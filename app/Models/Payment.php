<?php

namespace App\Models;

use App\Models\Scopes\PaymentScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_application_id',  //
        'payment_status',           //p 
        'payment_type',             //
        'payment_amount',           // 2000.00
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new PaymentScope());
    }

    public static function calculateMonthlyPayments():array{
        $monthlyPayments = DB::table('payments')
        ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month'), DB::raw('SUM(payment_amount) as total'))
        ->whereYear('created_at', Carbon::now()->year) // Filter by the current year
        ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
        ->get();
        $monthlyTotals = array_fill(1, 12, 0);

        foreach ($monthlyPayments as $payment) {
            $year = $payment->year;
            $month = $payment->month;
            $total = $payment->total;    
            $monthlyTotals[$month] = $total;
        }

        return array_values($monthlyTotals);
    }

    public static function getPaymentStatus(string $customerApplicationDueDate): string
    {
        $due_date = $customerApplicationDueDate;
        $today = Carbon::today();
    
        $delinquent = $today->copy()->addDays(30);
    
        $parsed_date = Carbon::createFromFormat(config('app.date_format'), $due_date);
    
        if ($today->lt($parsed_date)) {
            // Payment is in advance
            return "Advance";
        } elseif ($today->eq($parsed_date)) {
            // Payment is current
            return "Current";
        } elseif ($today->gt($parsed_date) && $today->lt($delinquent)) {
            // Payment is overdue
            return "Overdue";
        } elseif ($today->gt($delinquent)) {
            // Payment is delinquent
            return "Delinquent";
        } else {
            return "Unknown";
        }
    }


    // public static function calculateUnitDownpayment(float $unitPrice, float $rate, int $term, float $downPaymentPercentage): float
    // {
    //     // Calculate the down payment amount based on the percentage
    //     $dp_amount = $downPaymentPercentage / 100 * $unitPrice;
    
    //     // Calculate the principal amount (unit price - down payment)
    //     $principal = $unitPrice - $dp_amount;
    
    //     // Get the monthly interest rate (replace with your actual monthly interest rate)
    //     $monthly_interest_rate = $rate / 100 / 12; // Convert annual rate to monthly and percentage to decimal
    
    //     // Calculate the number of payments (term of the installment in months)
    //     $number_of_payments = $term;
    
    //     // Calculate the monthly payment using the loan payment formula
    //     $monthly_payment = ($principal * $monthly_interest_rate) / (1 - pow(1 + $monthly_interest_rate, -$number_of_payments));
    
    //     // Round the monthly payment to 2 decimal places
    //     $monthly_payment = round($monthly_payment, 2);
    
    //     // You can return the result or use it as needed
    //     return $monthly_payment;
    // }

    public static function calculateDeductionsCashPayment(float $unitPrice, float $rate): float
    {
        // Check if $rate is zero before performing the division
        if ($rate == 0) {
            // Handle the division by zero case, for example, return a default value or throw an exception
            // In this example, I'm returning 0, but you may choose a different default value or handle it differently based on your requirements.
            return 0;
        }
    
        $rate /= 100;
        $deduction = $unitPrice * $rate;
        return $deduction;
    }

    public static function calculateAmountMonthlyPayment(float $unitPrice, float $downpayment, int $termInMonths, float $monthlyInterestRate): float
    {
        // Check if the monthly interest rate is 0
        if ($monthlyInterestRate == 0) {
            // If there is no interest, return the total amount divided by the total number of payments
            return ($unitPrice - $downpayment) / $termInMonths;
        }

        // Calculate the present value of the loan (PV)
        $presentValue = $unitPrice - $downpayment;

        // Calculate the monthly payment using the corrected formula
        $monthlyPayment = ($monthlyInterestRate * $presentValue) / (1 - pow(1 + $monthlyInterestRate, -$termInMonths));

        return $monthlyPayment;
    }

    
    public static function calculateCashPayment(float $unitPrice, float $rate): float
    {

        $discountedPrice = $unitPrice - static::calculateDeductionsCashPayment($unitPrice, $rate);
        return $discountedPrice;
    }

    public static function calculatePayment(float $amount, float $rate): float
    {

        $discountedPrice = $amount - static::calculateDeductionsCashPayment($amount, $rate);
        return $discountedPrice;
    }


    public function customerApplication():BelongsTo{
        return $this->belongsTo(CustomerApplication::class);
    }
    
}
