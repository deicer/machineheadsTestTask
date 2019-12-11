function reduceStrings(string $str1 = '', string $str2 = '')
	{
		// Разбиваем строки на массивы слов разделенных ","
		$preparedStr1 = preg_split("/[,]+/", $str1);
		$preparedStr2 = preg_split("/[,]+/", $str2);


		// Функция возвращает массив из последовательно совпадающих элементов двух массивов
		$findMatching = static function (array $str1, array $str2) {
			$find = [];
			foreach ($str1 as $index => $word1) {
				if (isset($str2[$index]) && $word1 === $str2[$index]) {
					$find [] = $word1;
				} else {
					break;
				}
			}

			return $find;
		};

		if ($preparedStr1[0] === $preparedStr2[0]) {
			// Если первые элементы совпадают, значит обе строки
			// корректные, нужное совпадение в первом элементе
			return $preparedStr1[0];
		} else {
			// Если первые элементы не совпадают, одна из строк с ошибочным разделителем
			// ищем общее между первыми элементами по разделителю "пробел".
			$preparedStr1 = preg_split("/[\s]+/", $preparedStr1[0]);
			$preparedStr2 = preg_split("/[\s]+/", $preparedStr2[0]);
			$result       = $findMatching($preparedStr1, $preparedStr2);

			return implode(' ', $result);
		}
	}
