<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'status',
        'payment_method',
        'payment_status',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'notes',
        'order_date',
        'delivery_date'
    ];

    protected $casts = [
        'order_date' => 'datetime',
        'delivery_date' => 'datetime',
        'total_amount' => 'decimal:2'
    ];

    // Relationship với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship với OrderItems
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Generate order number
    public static function generateOrderNumber()
    {
        $date = Carbon::now()->format('Ymd');
        $lastOrder = self::whereDate('created_at', Carbon::today())->latest()->first();

        if ($lastOrder) {
            $lastNumber = intval(substr($lastOrder->order_number, -4));
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return 'ORD' . $date . $newNumber;
    }

    // Get status in Vietnamese
    public function getStatusInVietnamese()
    {
        $statuses = [
            'pending' => 'Chờ xác nhận',
            'confirmed' => 'Đã xác nhận',
            'preparing' => 'Đang chuẩn bị',
            'ready' => 'Sẵn sàng',
            'delivered' => 'Đã giao',
            'cancelled' => 'Đã hủy'
        ];

        return $statuses[$this->status] ?? $this->status;
    }
    // Get payment method in Vietnamese
    public function getPaymentMethodInVietnamese()
    {
        $methods = [
            'cod' => 'Thanh toán khi nhận hàng',
            'bank_transfer' => 'Chuyển khoản ngân hàng',
            'momo' => 'Ví MoMo',
            'vnpay' => 'VNPay'
        ];

        return $methods[$this->payment_method] ?? $this->payment_method;
    }
    // Get payment status in Vietnamese
    public function getPaymentStatusInVietnamese()
    {
        $statuses = [
            'pending' => 'Chờ thanh toán',
            'paid' => 'Đã thanh toán',
            'failed' => 'Thanh toán thất bại'
        ];

        return $statuses[$this->payment_status] ?? $this->payment_status;
    }
}
