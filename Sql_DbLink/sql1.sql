SELECT	 tem.data,
         Count(*) AS quantidade
FROM     (
		SELECT *
                FROM    dblink(
					'dbname=aghu_50
					hostaddr=127.0.0.1
					user=postgres
					password=postgres
					port=5433', 
					'	
						SELECT	   to_char(INT.dthr_internacao, ''yyyy/mm'') AS data
					 	FROM       agh.ain_internacoes INT
						INNER JOIN agh.agh_especialidades esp
						ON         INT.esp_seq = esp.seq
						WHERE      to_char(INT.dthr_internacao, ''yyyy/mm'') BETWEEN to_char(current_date - interval ''5 month'',''yyyy/mm'') AND to_char(current_date,''yyyy/mm'')
						ORDER BY   to_char(INT.dthr_internacao, ''yyyy/mm'')
					 ' 
			      ) AS resultado(data VARCHAR)

                UNION ALL

                SELECT *
                FROM    dblink(
					'dbname=am0106_hmars
					hostaddr=127.0.0.1
					user=postgres
					password=postgres
					port=5433', 
					'	
						SELECT	   to_char(INT.dthr_internacao, ''yyyy/mm'') AS data
					 	FROM       agh.ain_internacoes INT
						INNER JOIN agh.agh_especialidades esp
						ON         INT.esp_seq = esp.seq
						WHERE      to_char(INT.dthr_internacao, ''yyyy/mm'') BETWEEN to_char(current_date - interval ''5 month'',''yyyy/mm'') AND to_char(current_date,''yyyy/mm'')
						ORDER BY   to_char(INT.dthr_internacao, ''yyyy/mm'')
					 ' 
			      ) AS resultado(data VARCHAR)

                UNION ALL

                SELECT *
                FROM    dblink(
					'dbname=am0106_hmacn
					hostaddr=127.0.0.1
					user=postgres
					password=postgres
					port=5433', 
					'	
						SELECT	   to_char(INT.dthr_internacao, ''yyyy/mm'') AS data
					 	FROM       agh.ain_internacoes INT
						INNER JOIN agh.agh_especialidades esp
						ON         INT.esp_seq = esp.seq
						WHERE      to_char(INT.dthr_internacao, ''yyyy/mm'') BETWEEN to_char(current_date - interval ''5 month'',''yyyy/mm'') AND to_char(current_date,''yyyy/mm'')
						ORDER BY   to_char(INT.dthr_internacao, ''yyyy/mm'')
					 ' 
			      ) AS resultado(data VARCHAR)
     ) AS tem
GROUP BY tem.data
ORDER BY tem.data";


		$consulta = $jaba_db->query($executa); 
		$monta = "";
		$mes_ano = "";

		$i = 0;

		while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
	     	$mes_ano  .=  '[' . $i . ',"' .  $linha['data'] . '"]' . ',';
			$monta    .=  '[' . $i . ',' .  $linha['quantidade'] . ']' . ',';
			$i++;
		}								

		$monta = "[" . substr ($monta, 0, strlen($monta) -1 ) . "]";
		$mes_ano = "[" . substr ($mes_ano, 0, strlen($mes_ano) -1 ) . "]