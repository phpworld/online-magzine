<?php

namespace App\Controllers;
use App\Models\CategoriesModel;
use App\Models\AdminModel;
use App\Models\MagazineModel;
use App\Models\UserModel;
use App\Models\SubscriptionModel;

class AdminController extends BaseController
{
    
    
    protected $categoriesModel;

    public function __construct()
    {
        $this->categoriesModel = new CategoriesModel();
    }


    public function login()
    {
        helper(['form']);

        if ($this->request->getMethod() == 'POST') {
            $model = new AdminModel();
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');

            $admin = $model->where('email', $email)->first();

            if ($admin && password_verify($password, $admin['password'])) {
                // Set session data for admin
                session()->set([
                    'admin_id' => $admin['id'],
                    'admin_name' => $admin['name'],
                    'isAdminLoggedIn' => true,
                ]);

                return redirect()->to('/admin/dashboard');
            } else {
                return view('admin/index', ['error' => 'Invalid credentials.']);
            }
        }

        return view('admin/index');
    }

 public function dashboard()
{
    if (!session()->get('isAdminLoggedIn')) {
        return redirect()->to('/admin/login');
    }

    $db = \Config\Database::connect();
    
    // Total Sales
    $totalSalesQuery = $db->query("SELECT SUM(amount) AS total_sales FROM payments WHERE payment_status = 'completed'");
    $totalSales = $totalSalesQuery->getRow()->total_sales ?? 0;

    // Pending Sales
    $pendingSalesQuery = $db->query("SELECT SUM(amount) AS pending_sales FROM payments WHERE payment_status = 'pending'");
    $pendingSales = $pendingSalesQuery->getRow()->pending_sales ?? 0;

    // Total Users
    $totalUsersQuery = $db->query("SELECT COUNT(*) AS total_users FROM users");
    $totalUsers = $totalUsersQuery->getRow()->total_users ?? 0;

    // Monthly Sales
    $monthlySalesQuery = $db->query("SELECT SUM(amount) AS monthly_sales FROM payments WHERE payment_status = 'completed' AND MONTH(payment_date) = MONTH(CURRENT_DATE)");
    $monthlySales = $monthlySalesQuery->getRow()->monthly_sales ?? 0;

    // Pending Monthly Sales
    $pendingMonthlySalesQuery = $db->query("SELECT SUM(amount) AS pending_monthly_sales FROM payments WHERE payment_status = 'pending' AND MONTH(payment_date) = MONTH(CURRENT_DATE)");
    $pendingMonthlySales = $pendingMonthlySalesQuery->getRow()->pending_monthly_sales ?? 0;

    // Load dashboard view with required data
    return view('admin/dashboard', [
        'total_sales' => $totalSales,
        'pending_sales' => $pendingSales,
        'total_users' => $totalUsers,
        'monthly_sales' => $monthlySales,
        'pending_monthly_sales' => $pendingMonthlySales,
    ]);
}


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }

    // Function to upload a new magazine
public function uploadMagazine()
{
    helper(['form']);

    // Load the category model to fetch available categories
    $categoryModel = new CategoriesModel();
    $categories = $categoryModel->findAll();

    // Check if the request method is POST
    if ($this->request->getMethod() == 'POST') {
        $model = new MagazineModel();

        // Validate the form inputs and files
        $validated = $this->validate([
            'title' => 'required',
            'issue_date' => 'required|valid_date',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|is_not_unique[categories.id]', // Ensure category is valid
            'file' => 'uploaded[file]|mime_in[file,application/pdf]|max_size[file,10240]', // Max 10MB for the magazine PDF
            'cover_image' => 'uploaded[cover_image]|is_image[cover_image]|max_size[cover_image,2048]' // Max 2MB for the cover image
        ]);

        // If validation fails, return back with an error message
        if (!$validated) {
            return redirect()->back()->with('error', 'Please check your input and file formats.')->withInput();
        }

        // Handle the magazine PDF upload
        $pdfFile = $this->request->getFile('file');
        if ($pdfFile->isValid() && !$pdfFile->hasMoved()) {
            $pdfFileName = $pdfFile->getRandomName(); // Generate a unique name for the file
            $pdfFile->move(WRITEPATH . '../public/magazines', $pdfFileName); // Move file to the designated folder
        } else {
            return redirect()->back()->with('error', 'Error uploading the PDF file.');
        }

        // Handle the cover image upload
        $coverImageFile = $this->request->getFile('cover_image');
        if ($coverImageFile->isValid() && !$coverImageFile->hasMoved()) {
            $coverImageName = $coverImageFile->getRandomName(); // Generate a unique name for the image
            $coverImageFile->move(WRITEPATH . '../public/magazine_covers/', $coverImageName); // Move image to designated folder
        } else {
            return redirect()->back()->with('error', 'Error uploading the cover image.');
        }

        // Prepare the data for insertion
        $data = [
            'title' => $this->request->getVar('title'),
            'issue_date' => $this->request->getVar('issue_date'),
            'description' => $this->request->getVar('description'),
            'price' => $this->request->getVar('price'),
            'category_id' => $this->request->getVar('category_id'), // Add the selected category ID
            'file_path' => $pdfFileName, // Store the PDF file name
            'cover_image' => $coverImageName, // Store the cover image name
        ];

        // Insert the data into the database
        $model->insert($data);

        // Redirect to the magazine list with a success message
        return redirect()->to('/admin/magazines')->with('success', 'Magazine uploaded successfully.');
    }

    // If the request is not POST, show the upload form
    return view('admin/upload_magazine', ['categories' => $categories]); // Pass categories to view
}

    // Function to list all uploaded magazines
    public function listMagazines()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin/login');
        }

        $model = new MagazineModel();
        $data['magazines'] = $model->findAll();

        return view('admin/magazines', $data);
    }

    // Function to edit a magazine's details
    public function editMagazine($id)
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin/login');
        }

        $model = new MagazineModel();
        $magazine = $model->find($id);

        if ($this->request->getMethod() == 'post') {
            $file = $this->request->getFile('file');
            if ($file->isValid() && !$file->hasMoved()) {
                $filePath = $file->store();
                $magazine['file_path'] = $filePath;
            }

            $magazine['title'] = $this->request->getVar('title');
            $magazine['issue_date'] = $this->request->getVar('issue_date');
            $magazine['description'] = $this->request->getVar('description');
            $magazine['price'] = $this->request->getVar('price');

            $model->save($magazine);

            return redirect()->to('/admin/magazines')->with('success', 'Magazine updated successfully.');
        }

        return view('admin/edit_magazine', ['magazine' => $magazine]);
    }

    // Function to delete a magazine
    public function deleteMagazine($id)
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin/login');
        }

        $model = new MagazineModel();
        $model->delete($id);

        return redirect()->to('/admin/magazines')->with('success', 'Magazine deleted successfully.');
    }

    // Function to manage users
   public function manageUsers()
{
    if (!session()->get('isAdminLoggedIn')) {
        return redirect()->to('/admin/login');
    }

    $userModel = new UserModel();

    // Get the current page number from the query string, default to 1
    $page = $this->request->getGet('page') ?? 1;

    // Set the number of users per page
    $perPage = 10; // You can adjust this as needed

    // Fetch users with pagination
    $data['users'] = $userModel->paginate($perPage);
    $data['pager'] = $userModel->pager; // This is for the pagination links

    return view('admin/manage_users', $data);
}

//////// Active & Inactive users 
public function updateUserStatus($id)
{
    $userModel = new UserModel();

    // Check if the request method is POST
    if ($this->request->getMethod() !== 'POST') {
        return $this->response->setJSON(['success' => false, 'message' => 'Invalid request method.']);
    }

    // Get the current status
    $user = $userModel->find($id);
    if (!$user) {
        return $this->response->setJSON(['success' => false, 'message' => 'User not found.']);
    }

    // Toggle the user's status
    $newStatus = ($user['status'] == 1) ? 0 : 1; // Switch between active (1) and inactive (0)

    // Update the user's status
    try {
        $userModel->update($id, ['status' => $newStatus]);
        return $this->response->setJSON(['success' => true, 'message' => 'User status updated successfully.']);
    } catch (\Exception $e) {
        return $this->response->setJSON(['success' => false, 'message' => 'Error updating status: ' . $e->getMessage()]);
    }
}




    // Function to view a specific user profile
    public function viewUser($id)
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin/login');
        }

        $userModel = new UserModel();
        $data['user'] = $userModel->find($id);

        return view('admin/view_user', $data);
    }

    // Function to manage subscriptions
    public function manageSubscriptions()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin/login');
        }

        $subscriptionModel = new SubscriptionModel();
        $data['subscriptions'] = $subscriptionModel->findAll();

        return view('admin/manage_subscriptions', $data);
    }

    // Function to view reports
    public function viewReports()
    {
        if (!session()->get('isAdminLoggedIn')) {
            return redirect()->to('/admin/login');
        }

        // Generate reports data (e.g., sales, subscriptions, user growth)
        $data = [
            'total_sales' => 10000, // Dummy data
            'active_subscriptions' => 150, // Dummy data
            // Add more report data as needed
        ];

        return view('admin/reports', $data);
    }
    ///////////////
    

    // Create a new category
    public function createCategory()
    {
        $data = [
            'category_name' => $this->request->getPost('category_name'),
        ];

        $this->categoriesModel->createCategory($data);
        return redirect()->to('/admin/categories');
    }

    // Fetch and display all categories
    public function listCategories()
    {
        $data['categories'] = $this->categoriesModel->getAllCategories();
        return view('admin/categories_list', $data);
    }

   //Edit categories
   
   public function edit_category($id)
{
    //$model = new categoriesModel(); // Assuming you have a CategoryModel
    $data['category'] = $this->categoriesModel->find($id); // Fetch the category by ID

    return view('admin/edit_category', $data);
}

    // Update a category
    public function updateCategory($id)
    {
        $data = [
            'category_name' => $this->request->getPost('category_name'),
        ];

        $this->categoriesModel->updateCategory($id, $data);
        return redirect()->to('/admin/categories');
    }

    // Delete a category
    public function deleteCategory($id)
    {
        $this->categoriesModel->deleteCategory($id);
        return redirect()->to('/admin/categories');
    }
    
    
    
}
