<?php
namespace App\Models;
use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'amount',
        'payment_date',
        'payment_status',
        'transaction_id',
		'magazineId',
        'created_at'
    ];

    public function saveTransaction($userId, $amount, $status, $transactionId = null,$magazineId)
    {
        $data = [
            'user_id' => $userId,
            'amount' => $amount,
            'payment_date' => date('Y-m-d H:i:s'),
            'payment_status' => $status,
            'transaction_id' => $transactionId,
			'magazineId'  => $magazineId,
            'created_at' => date('Y-m-d H:i:s')
        ];

        return $this->insert($data);
    }
	
	public function updateTransactionStatus($transactionId, $status)
    {
        $this->where('transaction_id', $transactionId)
             ->set('payment_status', $status)
             ->update();
    }
	
	public function getUserCompletedMagazines($userId)
    {
        $builder = $this->db->table('payments');
        $builder->select('magazines.id, magazines.title, magazines.description, magazines.file_path, magazines.cover_image, magazines.price');
        $builder->join('magazines', 'payments.magazineId = magazines.id', 'inner');
        $builder->where('payments.user_id', $userId);
        $builder->where('payments.payment_status', 'completed');
        $query = $builder->get();

        return $query->getResultArray();
    }
	
	
	
}
