<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    // TAMBAHAN: Angka -2 berarti prioritas tertinggi (paling atas)
    protected static ?int $sort = -2;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Products', Product::count())
                ->description('All available items')
                ->descriptionIcon('heroicon-m-cube')
                ->color('success'),

            Stat::make('Total Orders', Order::count())
                ->description('All time orders')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('warning'),

            Stat::make('Total Revenue', 'Rp ' . number_format(Order::where('payment_status', 'completed')->sum('total_price'), 0, ',', '.'))
                ->description('From completed orders')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('primary'),
        ];
    }
}
