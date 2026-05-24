<?php
 
	function displayTotalPayment()
		{
			mysql_query("SET character_set_results=utf8", $this->dbLink);
			$this->sqlQuery = "SELECT * FROM product WHERE product.status = 1 AND product.quantity>0 ";
			$this->dbResult = mysql_query($this->sqlQuery, $this->dbLink);
			$this->total = 0;
			while($this->dbRow = mysql_fetch_object($this->dbResult))
			{
				echo 'Employee ID # ' . $this->dbRow->id . '<br />';
				echo 'Salary: ' . $this->dbRow->salary . '<br />';
				echo 'Bonus: ' . $this->dbRow->bonus . '<br />';
				$totalPayment = $this->convertToEnglishNumber($this->dbRow->salary) + 
				$this->convertToEnglishNumber($this->dbRow->bonus);
				echo 'Total Payment: ' . $this->convertToBanglaNumber($totalPayment) . '<br />';
				echo '<br /><br />';
			}
			
		}
 
		function convertToEnglishNumber($unicodeNumber)
		{
		
			$englishNumber = mb_convert_encoding($unicodeNumber,"HTML-ENTITIES","UTF-8");
			$englishNumber = str_replace('&#2534;', '0', $englishNumber);
			$englishNumber = str_replace('&#2535;', '1', $englishNumber);
			$englishNumber = str_replace('&#2536;', '2', $englishNumber);
			$englishNumber = str_replace('&#2537;', '3', $englishNumber);
			$englishNumber = str_replace('&#2538;', '4', $englishNumber);
			$englishNumber = str_replace('&#2539;', '5', $englishNumber);
			$englishNumber = str_replace('&#2540;', '6', $englishNumber);
			$englishNumber = str_replace('&#2541;', '7', $englishNumber);
			$englishNumber = str_replace('&#2542;', '8', $englishNumber);
			$englishNumber = str_replace('&#2543;', '9', $englishNumber);
			return $englishNumber;
		}
 
		function convertToBanglaNumber($englishNumber)
		{
			$englishNumber = (string) $englishNumber;
			$banglaNumber = '';
			$indexLimit = strlen($englishNumber);
			for($i=0; $i<$indexLimit; $i++)
			{
				switch($englishNumber[$i])
				{
					case "0":
						$banglaNumber .= '&#2534;';
						break;
					case "1":
						$banglaNumber .= '&#2535;';
						break;
					case "2":
						$banglaNumber .= '&#2536;';
						break;
					case "3":
						$banglaNumber .= '&#2537;';
						break;
					case "4":
						$banglaNumber .= '&#2538;';
						break;
					case "5":
						$banglaNumber .= '&#2539;';
						break;
					case "6":
						$banglaNumber .= '&#2540;';
						break;
					case "7":
						$banglaNumber .= '&#2541;';
						break;
					case "8":
						$banglaNumber .= '&#2542;';
						break;
					case "9":
						$banglaNumber .= '&#2543;';
						break;
					default:
						$banglaNumber .= $englishNumber[$i];
						break;
				}
			}
			return $banglaNumber;
		}
?>