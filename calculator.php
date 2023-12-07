<?php

class Calculator
{
        private $currentValue;

        public function __construct($initialValue = 0)
        {
            $this->currentValue = $initialValue;
        }

        public function applyInstruct($operator, $operand)
        {
            switch ($operator) {
                case 'add':
                    $this->currentValue += $operand;
                    break;
                case 'subtract':
                    $this->currentValue -= $operand;
                    break;
                case 'multiply':
                    $this->currentValue *= $operand;
                    break;
                case 'divide':
                    if ($operand != 0) {
                        $this->currentValue /= $operand;
                    } else {
                        $this->currentValue = 0;
                    }
                    break;
                case 'apply':
                    $this->currentValue = $operand; // Set the initial value
                    break;
                default:
                    throw new InvalidArgumentException("Error: Unknown operator '$operator'\n");
                    break;
            }
        }

        public function result()
        {
            return $this->currentValue;
        }
    }

    function calculateInstructions($filename)
    {
        $calculator = new Calculator();

        // Read instructions from file
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if ($lines === false) {
            throw new InvalidArgumentException("Error: Unable to read file '$filename'\n");
            return;
        }

        $parts = explode(' ', $lines[count($lines) - 1], 2);
        
        if (count($parts) == 2) {
            $operator = strtolower(trim($parts[0]));
            $operand = floatval(trim($parts[1]));

            $calculator->applyInstruct($operator, $operand);
        } else {
            throw new InvalidArgumentException("Error: Invalid instruction format - \n".count($lines) - 1);
        }
        
        for($i = 0; $i < count($lines) - 1; $i++) {
            $parts = explode(' ', $lines[$i], 2);
            
            if (count($parts) == 2) {
                $operator = strtolower(trim($parts[0]));
                $operand = floatval(trim($parts[1]));
                
                if($operator != 'apply'){
                    $calculator->applyInstruct($operator, $operand);
                }

            } else {
                throw new InvalidArgumentException();
            }
        }

        return $calculator->result();
    }

    header('Content-Type: application/json'); 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $filename = $_FILES['file']['tmp_name'];
            try {
                $result = calculateInstructions($filename);
                echo json_encode(['result' => $result]);
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }
        } else {
            echo json_encode(['error' => 'File upload failed']);
        }
    }
?>