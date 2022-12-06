<?php
/**
 * A spacial controller for the nice popup to show the product
 */

class ShowController {

    private $product_color = array();
    private $product_memory = array();
    private $id;
    /** only for show_product.php no Exception needed
     * @return Product
     */
    public function getProductShow() {
        $clicked_product = new Product();
        $this->id = $_POST['clicked_id'];
        $clicked_product = Product::getProductById($this->id);
        return $clicked_product[0];
    }
    /**
     * list alls product-options from id: color or memory
     */
    private function generateOption(){
        $data['options'] = Option::getOptionById($this->id);
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        foreach ($options as $option) {
            if ($option->getType() === 'color') {
                array_push($this->product_color, $option);
            }
            if ($option->getType() === 'memory') {
                array_push($this->product_memory, $option);
            }
        }
    }
    /**
     * list only color options
     */
    public function getColorOptions() {
        if(empty($this->product_color)){
            $this->generateOption();
        }
        return $this->product_color;
    }
    /**
     * list only memory options
     */
    public function getMemoryOptions(){
        if(empty($this->product_memory)){
            $this->generateOption();
        }
        return $this->product_memory;
    }
}
