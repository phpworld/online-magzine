<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriesModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['category_name', 'created_at', 'updated_at'];

    // Use timestamps for automatic handling of created_at and updated_at fields
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get a single category by its ID
     * @param int $id
     * @return array|null
     */
    public function getCategoryById($id)
    {
        return $this->where('id', $id)->first();
    }

    /**
     * Get all categories
     * @return array
     */
    public function getAllCategories()
    {
        return $this->findAll();
    }

    /**
     * Create a new category
     * @param array $data
     * @return bool
     */
    public function createCategory($data)
    {
        return $this->insert($data);
    }

    /**
     * Update a category by its ID
     * @param int $id
     * @param array $data
     * @return bool
     */
     public function updateCategory($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Delete a category by its ID
     * @param int $id
     * @return bool
     */
    public function deleteCategory($id)
    {
        return $this->delete($id);
    }
}
