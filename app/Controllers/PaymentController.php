<?php
namespace App\Controllers;

use App\Models\PaymentModel;

use CodeIgniter\Controller;

class PaymentController extends Controller
{  
    protected $session;

    public function __construct()
    {
        // Load the session service
        $this->session = \Config\Services::session();

        // Retrieve all session data
        $this->allSessionData = $this->session->get();

        // Optionally, you can access specific session data here if needed
        $this->userId = $this->session->get('id');
        $this->email = $this->session->get('email');
    }

    public function processPayment()
    {
        $amount = $this->request->getPost('amountEnterByUsers');
        $magazineId = $this->request->getPost('id');
        $userId = $this->userId; 
        
        // Generate a unique transaction ID
        $dateTime = date('ymdHis'); // Format: ymdHis (year, month, day, hour, minute, second)
        $uniqueNumber = mt_rand(1000, 9999); // 4-digit random number
        $merchantTransactionId = 'MT' . $dateTime . $uniqueNumber;

        // Payment data setup
        $merchantKey = '3cb6a6d7-5ae4-4a01-9bdc-61f27ccefe46'; // Merchant Key from PhonePe
        $data = [
            "merchantId" => "PHONEPEPGTEST43", // Merchant ID from PhonePe
            "merchantTransactionId" => $merchantTransactionId, // Unique transaction ID
            "merchantUserId" => $userId, // Use actual user ID
            "amount" => $amount * 100, // Convert to paisa
            "redirectUrl" => base_url('paymentsuccess'),
            "redirectMode" => "POST",
            "callbackUrl" => base_url('paymentsuccess'),
			"mobileNumber" => " ", // Mobile number from database
            "paymentInstrument" => [
                "type" => "PAY_PAGE"
            ]
        ];

        // Convert the payload to JSON and encode as Base64
        $payloadMain = base64_encode(json_encode($data));
        $payload = $payloadMain . "/pg/v1/pay" . $merchantKey;
        $checksum = hash('sha256', $payload) . '###1';

        // Prepare the cURL request
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode(['request' => $payloadMain]),
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "X-VERIFY: " . $checksum,
                "accept: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        // Load PaymentModel
        $paymentModel = new PaymentModel();

        if ($err) {
            // Handle cURL error and save transaction as failed
            $paymentModel->saveTransaction($userId, $amount, 'failed');
            return redirect()->to(base_url('paymentfailed'))->with('error', 'cURL Error: ' . $err);
        } else {
            $responseData = json_decode($response, true);
			
            if (isset($responseData['data']['instrumentResponse']['redirectInfo']['url'])) {
                $transactionId = $responseData['data']['merchantTransactionId'] ?? 'N/A'; // Extract the transaction ID from the response
               
			   // Save transaction as pending before redirecting
				$this->session->set('keep_alive', true);
                $paymentModel->saveTransaction($userId, $amount, 'pending', $transactionId,$magazineId);
				log_message('debug', 'Session data: ' . print_r($this->session->get(), true));
				$url = $responseData['data']['instrumentResponse']['redirectInfo']['url'];
				
				return redirect()->to($url);
            } else {
                $paymentModel->saveTransaction($userId, $amount, 'failed');
                return redirect()->to(base_url('paymentfailed'))->with('error', 'Payment failed. Please try again.');
            }
        }
    }

    public function paymentSuccess()
    {
		// Retrieve the transaction ID from POST data or query parameters
	     	$transactionId = $this->request->getPost('transactionId'); 
        
        $paymentModel = new PaymentModel();
      
        // Check if the transaction ID exists and update status
        if ($transactionId) {
            // Mark the transaction as completed
            $paymentModel->updateTransactionStatus($transactionId, 'completed');
			 }

        // Pass the transaction ID to the view
        return view('paymentsuccess', [
            'transaction_id' => $transactionId
        ]);
    }

    // Other methods like history remain unchanged
	
	public function showUserCompletedMagazines()
    {
        // Retrieve user ID from session or other authentication mechanism
        $userId = session()->get('id'); // Adjust this as needed
        
        $paymentModel = new PaymentModel();
        $data['completedMagazines'] = $paymentModel->getUserCompletedMagazines($userId);

        return view('my_magzines', $data);
    }
	
	
	public function payment_history()
{
    $model = new PaymentModel();

    // Get pagination parameters
    $limit = 10; // Records per page
    $page = $this->request->getGet('page') ?? 1; // Get current page from URL
    $offset = ($page - 1) * $limit; // Calculate offset

    // Fetch payment history with user names
    $data['payments'] = $model->getPaymentHistoryWithUserNames($limit, $offset);
    
    // Get total records for pagination
    $totalRecords = $model->getTotalPaymentRecords();
    $data['pager'] = $model->pager;
    $data['pager'] = \Config\Services::pager();
    $data['pager']->makeLinks($page, $limit, $totalRecords);

    return view('admin/payment_history', $data);
}

	
}
