<?php
class ControllerCommonTest extends Controller {
	
	public function index() {
		echo '<pre>';
		
		/* GET --------------------- */
		$name = DB::table('customer')->where('name', '����')->value('name');
		echo $name;
		
		$result = DB::table('product')->find([28, 29])->sortBy('product_id', 'DESC')->get();
		print_r($result);
		
		$result = DB::table('product')->limit(10)->page(1)->get();
		print_r($result);
		
		$result = DB::table('product')->first(10)->get();
		print_r($result);
		
		$result = DB::table('product')->last()->get(['name', 'password']);
		print_r($result);
		
		
		/* INSERT ------------------ */
		$result = DB::table('test')->insert([
			['key' => 'k1', 'value' => 'v1'],
			['key' => 'k2', 'value' => 'v2']
		]);
		
		print_r($result);
		
		$result = DB::table('test')->insert([
			'key' => 'k2',
			'value' => 'v2'
		]);
		
		print_r($result);
		
		
		/* UPDATE ------------------ */
		$result = DB::table('test')->update([
			['key' => 'k1', 'value' => 'v1'],
			['key' => 'k2', 'value' => 'v2']
		]);
		
		DB::table('test')->find(14)->increment('number');
		
		DB::table('test')->find(14)->decrement('number');
		
		DB::table('test')->find(14)->toggle('number');
		
		/* DELETE ------------------ */
		DB::table('test')->where('id', '>', 0)->delete();
		
		DB::table('test')->clear();
		
		
		echo '</pre>';
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function tree() {
		// 8 - ����
		// 9 - ˳���
		// 14 - ������� ��������� ���
		// 17 - ������� ��������� ��� �� ����� ������
		// 18 - ������� ��������� ��� �� �������� ������
		// 25 - Iphone 5s
		// 27 - ������ 2000
		
		echo '<pre>';
		
		$query = $this->db->multiQuery("CALL get_tree(27)");
		print_r($query->rows);
		
		echo '</pre>';
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function refreshProcedure() {
		$query = $this->db->query("DROP PROCEDURE IF EXISTS get_tree");
		
		$query = $this->db->query("
			CREATE PROCEDURE get_tree(IN current_id INT)
			BEGIN
				CREATE TEMPORARY TABLE IF NOT EXISTS temp_table AS (SELECT * FROM oc_test WHERE 1=0);
				REPEAT
					INSERT INTO temp_table SELECT * FROM oc_test WHERE id=current_id;
					SELECT parent_id INTO current_id FROM oc_test WHERE id=current_id;
				UNTIL current_id = 0
				END REPEAT;
				SELECT name FROM temp_table;
				DROP TABLE temp_table;
			END
		");
	}

}
