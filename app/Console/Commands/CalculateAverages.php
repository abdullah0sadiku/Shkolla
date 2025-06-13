<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Grade;
use App\Models\WeeklyReport;
use App\Models\MonthlyReport;
use App\Models\YearlyReport;
use DB;

class CalculateGrades extends Command
{
    // Command Signature (used to call it via CLI)
    protected $signature = 'grades:calculate';
    protected $description = 'Calculate weekly, monthly, and yearly averages for students';

    public function handle()
    {
        $this->info('Calculating Weekly, Monthly, and Yearly Averages...');

        // 🟢 Weekly Average Calculation
        DB::statement("
            INSERT INTO weekly_reports (user_id, class_id, week, weekly_average, created_at, updated_at)
            SELECT user_id, class_id, DATE_FORMAT(date, '%Y-W%v'), ROUND(AVG(total),2), NOW(), NOW()
            FROM grades WHERE date >= NOW() - INTERVAL 7 DAY
            GROUP BY user_id, class_id, week
            ON DUPLICATE KEY UPDATE weekly_average = VALUES(weekly_average), updated_at = NOW()
        ");

        // 🟢 Monthly Average Calculation
        DB::statement("
            INSERT INTO monthly_reports (user_id, class_id, month, monthly_average, created_at, updated_at)
            SELECT user_id, class_id, DATE_FORMAT(date, '%Y-%m'), ROUND(AVG(total),2), NOW(), NOW()
            FROM grades WHERE date >= NOW() - INTERVAL 30 DAY
            GROUP BY user_id, class_id, month
            ON DUPLICATE KEY UPDATE monthly_average = VALUES(monthly_average), updated_at = NOW()
        ");

        // 🟢 Yearly Average Calculation
        DB::statement("
            INSERT INTO yearly_reports (user_id, class_id, year, yearly_average, created_at, updated_at)
            SELECT user_id, class_id, YEAR(date), ROUND(AVG(total),2), NOW(), NOW()
            FROM grades
            GROUP BY user_id, class_id, year
            ON DUPLICATE KEY UPDATE yearly_average = VALUES(yearly_average), updated_at = NOW()
        ");

        $this->info('✅ Grades successfully calculated.');
    }
}
