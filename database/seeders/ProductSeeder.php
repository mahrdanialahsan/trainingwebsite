<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryNames = ['Shirts', 'Hats', 'Bags', 'Accessories', 'Safety Gear', 'Office'];
        $categoryMap = Category::whereIn('name', $categoryNames)->get()->keyBy('name');

        $products = [
            ['title' => 'Training Logo T-Shirt', 'category' => 'Shirts', 'price' => 24.99, 'sku' => 'TSH-LOGO-001', 'stock_quantity' => 100, 'order' => 1],
            ['title' => 'Safety First Polo Shirt', 'category' => 'Shirts', 'price' => 34.99, 'sku' => 'POLO-SF-002', 'stock_quantity' => 75, 'order' => 2],
            ['title' => 'Heavy Duty Work T-Shirt', 'category' => 'Shirts', 'price' => 22.99, 'sku' => 'TSH-HD-003', 'stock_quantity' => 120, 'order' => 3],
            ['title' => 'Long Sleeve Training Tee', 'category' => 'Shirts', 'price' => 28.99, 'sku' => 'TSH-LS-004', 'stock_quantity' => 80, 'order' => 4],
            ['title' => 'High-Visibility Yellow T-Shirt', 'category' => 'Shirts', 'price' => 26.99, 'sku' => 'TSH-HV-005', 'stock_quantity' => 90, 'order' => 5],
            ['title' => 'Cotton Blend Crew Neck', 'category' => 'Shirts', 'price' => 19.99, 'sku' => 'TSH-CB-006', 'stock_quantity' => 150, 'order' => 6],
            ['title' => 'Performance Dry-Fit Shirt', 'category' => 'Shirts', 'price' => 32.99, 'sku' => 'TSH-PF-007', 'stock_quantity' => 60, 'order' => 7],
            ['title' => 'V-Neck Training Shirt', 'category' => 'Shirts', 'price' => 21.99, 'sku' => 'TSH-VN-008', 'stock_quantity' => 85, 'order' => 8],
            ['title' => 'Reflective Striped Tee', 'category' => 'Shirts', 'price' => 29.99, 'sku' => 'TSH-RS-009', 'stock_quantity' => 70, 'order' => 9],
            ['title' => 'Branded Hoodie', 'category' => 'Shirts', 'price' => 49.99, 'sku' => 'HOD-BR-010', 'stock_quantity' => 50, 'order' => 10],
            ['title' => 'Baseball Cap - Navy', 'category' => 'Hats', 'price' => 18.99, 'sku' => 'CAP-NV-011', 'stock_quantity' => 200, 'order' => 11],
            ['title' => 'Baseball Cap - Black', 'category' => 'Hats', 'price' => 18.99, 'sku' => 'CAP-BK-012', 'stock_quantity' => 200, 'order' => 12],
            ['title' => 'High-Visibility Cap', 'category' => 'Hats', 'price' => 22.99, 'sku' => 'CAP-HV-013', 'stock_quantity' => 100, 'order' => 13],
            ['title' => 'Beanie - Winter', 'category' => 'Hats', 'price' => 16.99, 'sku' => 'BEE-WN-014', 'stock_quantity' => 80, 'order' => 14],
            ['title' => 'Trucker Cap', 'category' => 'Hats', 'price' => 19.99, 'sku' => 'CAP-TR-015', 'stock_quantity' => 90, 'order' => 15],
            ['title' => 'Safety Hard Hat', 'category' => 'Hats', 'price' => 24.99, 'sku' => 'HAT-SH-016', 'stock_quantity' => 60, 'order' => 16],
            ['title' => 'Mesh Back Cap', 'category' => 'Hats', 'price' => 17.99, 'sku' => 'CAP-MB-017', 'stock_quantity' => 110, 'order' => 17],
            ['title' => 'Visor Cap', 'category' => 'Hats', 'price' => 20.99, 'sku' => 'CAP-VS-018', 'stock_quantity' => 75, 'order' => 18],
            ['title' => 'Canvas Work Bag', 'category' => 'Bags', 'price' => 39.99, 'sku' => 'BAG-CW-019', 'stock_quantity' => 45, 'order' => 19],
            ['title' => 'Laptop Messenger Bag', 'category' => 'Bags', 'price' => 54.99, 'sku' => 'BAG-LM-020', 'stock_quantity' => 35, 'order' => 20],
            ['title' => 'Duffel Bag - Large', 'category' => 'Bags', 'price' => 44.99, 'sku' => 'BAG-DL-021', 'stock_quantity' => 40, 'order' => 21],
            ['title' => 'Backpack with Logo', 'category' => 'Bags', 'price' => 47.99, 'sku' => 'BAG-BP-022', 'stock_quantity' => 55, 'order' => 22],
            ['title' => 'Tool Pouch', 'category' => 'Bags', 'price' => 29.99, 'sku' => 'BAG-TP-023', 'stock_quantity' => 70, 'order' => 23],
            ['title' => 'Drawstring Sports Bag', 'category' => 'Bags', 'price' => 14.99, 'sku' => 'BAG-DS-024', 'stock_quantity' => 120, 'order' => 24],
            ['title' => 'Insulated Lunch Bag', 'category' => 'Bags', 'price' => 19.99, 'sku' => 'BAG-IL-025', 'stock_quantity' => 95, 'order' => 25],
            ['title' => 'Stainless Steel Water Bottle', 'category' => 'Accessories', 'price' => 24.99, 'sku' => 'ACC-WB-026', 'stock_quantity' => 130, 'order' => 26],
            ['title' => 'Insulated Travel Mug', 'category' => 'Accessories', 'price' => 22.99, 'sku' => 'ACC-TM-027', 'stock_quantity' => 100, 'order' => 27],
            ['title' => 'Keychain with Logo', 'category' => 'Accessories', 'price' => 6.99, 'sku' => 'ACC-KC-028', 'stock_quantity' => 300, 'order' => 28],
            ['title' => 'Lanyard with ID Holder', 'category' => 'Accessories', 'price' => 8.99, 'sku' => 'ACC-LN-029', 'stock_quantity' => 250, 'order' => 29],
            ['title' => 'Pen Set - Branded', 'category' => 'Accessories', 'price' => 12.99, 'sku' => 'ACC-PS-030', 'stock_quantity' => 180, 'order' => 30],
            ['title' => 'Notebook & Pen Combo', 'category' => 'Accessories', 'price' => 15.99, 'sku' => 'ACC-NP-031', 'stock_quantity' => 90, 'order' => 31],
            ['title' => 'Safety Glasses Case', 'category' => 'Accessories', 'price' => 9.99, 'sku' => 'ACC-SG-032', 'stock_quantity' => 140, 'order' => 32],
            ['title' => 'Wristband - Reflective', 'category' => 'Accessories', 'price' => 4.99, 'sku' => 'ACC-WR-033', 'stock_quantity' => 200, 'order' => 33],
            ['title' => 'Belt - Leather', 'category' => 'Accessories', 'price' => 34.99, 'sku' => 'ACC-BL-034', 'stock_quantity' => 50, 'order' => 34],
            ['title' => 'Safety Vest - Orange', 'category' => 'Safety Gear', 'price' => 19.99, 'sku' => 'VST-OR-035', 'stock_quantity' => 85, 'order' => 35],
            ['title' => 'Safety Vest - Yellow', 'category' => 'Safety Gear', 'price' => 19.99, 'sku' => 'VST-YL-036', 'stock_quantity' => 85, 'order' => 36],
            ['title' => 'Reflective Arm Bands', 'category' => 'Safety Gear', 'price' => 11.99, 'sku' => 'SFT-AB-037', 'stock_quantity' => 160, 'order' => 37],
            ['title' => 'Work Gloves - Pair', 'category' => 'Safety Gear', 'price' => 14.99, 'sku' => 'SFT-WG-038', 'stock_quantity' => 200, 'order' => 38],
            ['title' => 'Knee Pads', 'category' => 'Safety Gear', 'price' => 29.99, 'sku' => 'SFT-KP-039', 'stock_quantity' => 65, 'order' => 39],
            ['title' => 'Ear Plugs - Reusable', 'category' => 'Safety Gear', 'price' => 9.99, 'sku' => 'SFT-EP-040', 'stock_quantity' => 250, 'order' => 40],
            ['title' => 'First Aid Kit - Personal', 'category' => 'Safety Gear', 'price' => 24.99, 'sku' => 'SFT-FA-041', 'stock_quantity' => 70, 'order' => 41],
            ['title' => 'Flashlight - LED', 'category' => 'Safety Gear', 'price' => 18.99, 'sku' => 'SFT-FL-042', 'stock_quantity' => 95, 'order' => 42],
            ['title' => 'Whistle - Safety', 'category' => 'Safety Gear', 'price' => 5.99, 'sku' => 'SFT-WH-043', 'stock_quantity' => 300, 'order' => 43],
            ['title' => 'Training Manual Binder', 'category' => 'Office', 'price' => 16.99, 'sku' => 'OFF-BD-044', 'stock_quantity' => 80, 'order' => 44],
            ['title' => 'Certificate Frame', 'category' => 'Office', 'price' => 19.99, 'sku' => 'OFF-CF-045', 'stock_quantity' => 60, 'order' => 45],
            ['title' => 'Desk Organizer', 'category' => 'Office', 'price' => 27.99, 'sku' => 'OFF-DO-046', 'stock_quantity' => 45, 'order' => 46],
            ['title' => 'Mouse Pad - Branded', 'category' => 'Office', 'price' => 9.99, 'sku' => 'OFF-MP-047', 'stock_quantity' => 120, 'order' => 47],
            ['title' => 'Sticky Notes Pack', 'category' => 'Office', 'price' => 7.99, 'sku' => 'OFF-SN-048', 'stock_quantity' => 150, 'order' => 48],
            ['title' => 'Folder Set - 5 Pack', 'category' => 'Office', 'price' => 14.99, 'sku' => 'OFF-FS-049', 'stock_quantity' => 100, 'order' => 49],
            ['title' => 'USB Drive 32GB - Branded', 'category' => 'Office', 'price' => 22.99, 'sku' => 'OFF-UD-050', 'stock_quantity' => 75, 'order' => 50],
            ['title' => 'Polo Shirt - Grey', 'category' => 'Shirts', 'price' => 34.99, 'sku' => 'POLO-GR-051', 'stock_quantity' => 70, 'order' => 51],
            ['title' => 'Polo Shirt - Red', 'category' => 'Shirts', 'price' => 34.99, 'sku' => 'POLO-RD-052', 'stock_quantity' => 70, 'order' => 52],
            ['title' => 'Fleece Jacket', 'category' => 'Shirts', 'price' => 59.99, 'sku' => 'JKT-FL-053', 'stock_quantity' => 40, 'order' => 53],
            ['title' => 'Windbreaker', 'category' => 'Shirts', 'price' => 44.99, 'sku' => 'JKT-WB-054', 'stock_quantity' => 55, 'order' => 54],
            ['title' => 'Cotton Sweatshirt', 'category' => 'Shirts', 'price' => 39.99, 'sku' => 'SWT-CT-055', 'stock_quantity' => 65, 'order' => 55],
        ];

        $description = '<p>Quality merchandise for your training and safety needs. Durable, comfortable, and branded for professional use.</p>';

        foreach ($products as $index => $item) {
            $categoryId = $categoryMap->get($item['category'])?->id;
            Product::updateOrCreate(
                ['sku' => $item['sku']],
                [
                    'title' => $item['title'],
                    'description' => $description,
                    'price' => $item['price'],
                    'category_id' => $categoryId,
                    'stock_quantity' => $item['stock_quantity'],
                    'order' => $item['order'],
                    'is_active' => true,
                ]
            );
        }
    }
}
