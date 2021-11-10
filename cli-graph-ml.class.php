<?php

ini_set('default_charset', 'UTF-8');

/** cli-graph-ml.class.php
 *  
 * Class for visualize data in bar graph & detect outliers
 * 
 *     Months in %
 *      _____________
 *   38|___________▌_
 *   35|___________▌_
 * A 32|___________▌_
 * X 29|___________▌_
 * I 26|___________▌_
 * S 23|__________▌▌_
 *   20|_________▌▌▌_
 * Y 17|_______▌▌▌▌▌_
 *   14|______▌▌▌▌▌▌_
 *   11|___▌▌▌▌▌▌▌▌▌_
 *     +-------------
 *       |    |    |
 *      Jan  Jun  Dec
 *         AXIS X
 *      Max: 38
 *      Min: 1
 *      Sum: 132
 *      Avg: 12.00
 *      Median: 9.00
 *      Variance: 12.00
 *      Std Desv: 3.46
 *      O. Up Lim: 22.39
 *      O. Do Lim: 1.61
 *
 * 
 * 
 * @author Rafael Martin Soto
 * @author {@link https://www.inatica.com/ Inatica}
 * @blog {@link https://rafamartin10.blogspot.com/ Blog Rafael Martin Soto}
 * @since September 2021
 * @version 1.0.2
 * @license GNU General Public License v3.0
 * 
 * @param string $data
 * @param array $axis_x_values
 * @param string $config
 *
 * Some utils docs:
 * https://en.wikipedia.org/wiki/List_of_Unicode_characters
 * https://www.w3schools.com/charsets/ref_utf_box.asp
 * https://compwright.com/2012-11-26/box-drawing-in-php/
 * 
 * U+2580	▀	Upper half block
 * U+2581	▁	Lower one eighth block
 * U+2582	▂	Lower one quarter block
 * U+2583	▃	Lower three eighths block
 * U+2584	▄	Lower half block
 * U+2585	▅	Lower five eighths block
 * U+2586	▆	Lower three quarters block
 * U+2587	▇	Lower seven eighths block
 * U+2588	█	Full block
 * U+2589	▉	Left seven eighths block
 * U+258A	▊	Left three quarters block
 * U+258B	▋	Left five eighths block
 * U+258C	▌	Left half block
 * U+258D	▍	Left three eighths block
 * U+258E	▎	Left one quarter block
 * U+258F	▏	Left one eighth block
 * U+2590	▐	Right half block
 * 
 * U+2591	░	Light shade
 * 
 * U+2592	▒	Medium shade
 * 
 * U+2593	▓	Dark shade
 * 
 * U+2594	▔	Upper one eighth block
 * U+2595	▕	Right one eighth block
 * U+2596	▖	Quadrant lower left
 * U+2597	▗	Quadrant lower right
 * U+2598	▘	Quadrant upper left
 * U+2599	▙	Quadrant upper left and lower left and lower right
 * U+259A	▚	Quadrant upper left and lower right
 * U+259B	▛	Quadrant upper left and upper right and lower left
 * U+259C	▜	Quadrant upper left and upper right and lower right
 * U+259D	▝	Quadrant upper right
 * U+259E	▞	Quadrant upper right and lower left
 * U+259F	▟	Quadrant upper right and lower left and lower right
 * */

class cli_graph_ml
{
	private $Upper_half_block;
	private $Lower_one_eighth_block;
	private $Lower_one_quarter_block;
	private $Lower_three_eighths_block;
	private $Lower_half_block;
	private $Lower_five_eighths_block;
	private $Lower_three_quarters_block;
	private $Lower_seven_eighths_block;
	private $Full_block;
	private $Left_seven_eighths_block;
	private $Left_three_quarters_block;
	private $Left_five_eighths_block;
	private $Left_half_block;
	private $Left_three_eighths_block;
	private $Left_one_quarter_block;
	private $Left_one_eighth_block;
	private $Right_half_block;
	private $Light_shade;
	private $Medium_shade;
	private $Upper_one_eighth_block;
	private $Right_one_eighth_block;
	private $Quadrant_lower_left;
	private $Quadrant_lower_right;
	private $Quadrant_upper_left;
	private $Quadrant_upper_left_and_lower_left_and_lower_right;
	private $Quadrant_upper_left_and_lower_right;
	private $Quadrant_upper_left_and_upper_right_and_lower_left;
	private $Quadrant_upper_left_and_upper_right_and_lower_right;
	private $Quadrant_upper_right;
	private $Quadrant_upper_right_and_lower_left;
	private $Quadrant_upper_right_and_lower_left_and_lower_right;

	/**
	 * Border Characters
	 * see: https://unicode-table.com/en/blocks/box-drawing/
	 * @var    array
	 * @access private
	 **/
	private $border_chars = [
		'simple' => [
			'top'          => '-',
			'top-mid'      => '+',
			'top-left'     => '+',
			'top-right'    => '+',
			'bottom'       => '-',
			'bottom-mid'   => '+',
			'bottom-left'  => '+',
			'bottom-right' => '+',
			'left'         => '|',
			'left-mid'     => '+',
			'mid'          => '-',
			'mid-mid'      => '+',
			'right'        => '|',
			'right-mid'    => '+',
			'middle'       => '|'
			],
		'single' => [
			'right-mid'    => '+',
			'top'          => '─',
			'top-mid'      => '┬',
			'top-left'     => '┌',
			'top-right'    => '┐',
			'bottom'       => '─',
			'bottom-mid'   => '┴',
			'bottom-left'  => '└',
			'bottom-right' => '┘',
			'left'         => '│',
			'left-mid'     => '├',
			'mid'          => '─',
			'mid-mid'      => '┼',
			'right'        => '│',
			'right-mid'    => '┤',
			'middle'       => '│'
			],
		'double' => [
			'top'          => '═',
			'top-mid'      => '╦',
			'top-left'     => '╔',
			'top-right'    => '╗',
			'bottom'       => '═',
			'bottom-mid'   => '╩',
			'bottom-left'  => '╚',
			'bottom-right' => '╝',
			'left'         => '║',
			'left-mid'     => '╠',
			'mid'          => '═',
			'mid-mid'      => '╬',
			'right'        => '║',
			'right-mid'    => '╣',
			'middle'       => '║'
			],
		'double_single' => [
			'top'          => '═',
			'top-mid'      => '╤',
			'top-left'     => '╔',
			'top-right'    => '╗',
			'bottom'       => '═',
			'bottom-mid'   => '╧',
			'bottom-left'  => '╚',
			'bottom-right' => '╝',
			'left'         => '║',
			'left-mid'     => '╟',
			'mid'          => '─',
			'mid-mid'      => '┼',
			'right'        => '║',
			'right-mid'    => '╢',
			'middle'       => '│'
			]
	];

	/**
	 * colors
	 * chr(27).'[1;34m',
	 * @var    array
	 * @access private
	 **/
	private $text_colors = [
		'lightblue'     => '[1;34m',
		'lightred'      => '[1;31m',
		'lightgreen'    => '[1;32m',
		'lightyellow'   => '[1;33m',
		'lightblack'    => '[1;30m',
		'lightmagenta'  => '[1;35m',
		'lightcyan'     => '[1;36m',
		'lightwhite'    => '[1;37m',
		'blue'          => '[0;34m',
		'red'           => '[0;31m',
		'green'         => '[0;32m',
		'yellow'        => '[0;33m',
		'black'         => '[0;30m',
		'magenta'       => '[0;35m',
		'cyan'          => '[0;36m',
		'white'         => '[0;37m',
		'orange'        => '[38;5;214m', // if supported by the terminal
		'reset'         => '[0m'
	];

	private $text_colors_win32 = [
		'lightblue'     => '[?1;34m',
		'lightred'      => '[?1;31m',
		'lightgreen'    => '[?1;32m',
		'lightyellow'   => '[?1;33m',
		'lightblack'    => '[?1;30m',
		'lightmagenta'  => '[?1;35m',
		'lightcyan'     => '[?1;36m',
		'lightwhite'    => '[?1;37m',
		'blue'          => '[0;34m',
		'red'           => '[0;31m',
		'green'         => '[0;32m',
		'yellow'        => '[0;33m',
		'black'         => '[0;30m',
		'magenta'       => '[0;35m',
		'cyan'          => '[0;36m',
		'white'         => '[0;37m',
		'orange'        => '[38;5;214m', // if supported by the terminal
		'reset'         => '[0m'
	];

	/**
	 * Definition of Defaut Table Format values
	 * @var    array
	 * @access private
	 **/
	private $default_cfg = [
		'block_type'    => 'Full_block', // not used for now
		'orientation'   => 'V', // for now only 'V'
		'graph_type'    => 'bar', // For now only 'bar'
		'border_chars'  => 'simple', // for now only 'simple'
		'graph_length'  => 10,
		'bar_color'  => 'lightwhite',
		'title'  => '',
		'draw_underlines' => true,
		'underlines_every'  => 1,
		'bar_width'  => 1,
		'show_y_axis_title' => true,
		'show_x_axis_title' => true,
		'x_axis_title' => 'AXIS X',
		'y_axis_title' => 'AXIS Y',
		'padding_left' => 1,
		'padding_right' => 1,
		'padding_top' => 1,
		'padding_bottom' => 1,
		'explain_values' => true,
		'explain_values_same_line' => false,
		'outlier_factor' => 2
	];

	private $data = [];
	private $config = [];
	private $count_data;
	private $data_width;
	private $padding_left;
	private $padding_right;
	private $arr_output = [];
	private $axis_x_values = [];

	private $max_value;
	private $min_value;
	private $arr_prepare_output = [];
	private $arr_id_data_visible = []; // Array with the id's even the value is 0 and cannot be drawed in graph, but we need to know if there is a min() value in data. Then draw it with Lower_one_eighth_block

	public function __construct($data = null, array $axis_x_values = [], array $config = [])
	{
		$this->config = array_merge($this->default_cfg, $config);

		(!is_null($data)) AND $this->set_data($data);
		(!empty($axis_x_values)) AND $this->axis_x_values = $axis_x_values;

		if (PHP_OS_FAMILY === "Windows") { # PHP 7.2+
			$this->text_colors = $this->text_colors_win32;
		}

		$this->Upper_half_block                                     = html_entity_decode('▀', ENT_NOQUOTES, 'UTF-8');
		$this->Lower_one_eighth_block                               = html_entity_decode('▁', ENT_NOQUOTES, 'UTF-8');
		$this->Lower_one_quarter_block                              = html_entity_decode('▂', ENT_NOQUOTES, 'UTF-8');
		$this->Lower_three_eighths_block                            = html_entity_decode('▃', ENT_NOQUOTES, 'UTF-8');
		$this->Lower_half_block                                     = html_entity_decode('▄', ENT_NOQUOTES, 'UTF-8');
		$this->Lower_five_eighths_block                             = html_entity_decode('▅', ENT_NOQUOTES, 'UTF-8');
		$this->Lower_three_quarters_block                           = html_entity_decode('▆', ENT_NOQUOTES, 'UTF-8');
		$this->Lower_seven_eighths_block                            = html_entity_decode('▇', ENT_NOQUOTES, 'UTF-8');
		$this->Full_block                                           = html_entity_decode('█', ENT_NOQUOTES, 'UTF-8');
		$this->Left_seven_eighths_block                             = html_entity_decode('▉', ENT_NOQUOTES, 'UTF-8');
		$this->Left_three_quarters_block                            = html_entity_decode('▊', ENT_NOQUOTES, 'UTF-8');
		$this->Left_five_eighths_block                              = html_entity_decode('▋', ENT_NOQUOTES, 'UTF-8');
		$this->Left_half_block                                      = html_entity_decode('▌', ENT_NOQUOTES, 'UTF-8');
		$this->Left_three_eighths_block                             = html_entity_decode('▍', ENT_NOQUOTES, 'UTF-8');
		$this->Left_one_quarter_block                               = html_entity_decode('▎', ENT_NOQUOTES, 'UTF-8');
		$this->Left_one_eighth_block                                = html_entity_decode('▏', ENT_NOQUOTES, 'UTF-8');
		$this->Right_half_block                                     = html_entity_decode('▐', ENT_NOQUOTES, 'UTF-8');
		$this->Light_shade                                          = html_entity_decode('░', ENT_NOQUOTES, 'UTF-8');
		$this->Medium_shade                                         = html_entity_decode('▒', ENT_NOQUOTES, 'UTF-8');
		$this->Upper_one_eighth_block                               = html_entity_decode('▔', ENT_NOQUOTES, 'UTF-8');
		$this->Right_one_eighth_block                               = html_entity_decode('▕', ENT_NOQUOTES, 'UTF-8');
		$this->Quadrant_lower_left                                  = html_entity_decode('▖', ENT_NOQUOTES, 'UTF-8');
		$this->Quadrant_lower_right                                 = html_entity_decode('▗', ENT_NOQUOTES, 'UTF-8');
		$this->Quadrant_upper_left                                  = html_entity_decode('▘', ENT_NOQUOTES, 'UTF-8');
		$this->Quadrant_upper_left_and_lower_left_and_lower_right   = html_entity_decode('▙', ENT_NOQUOTES, 'UTF-8');
		$this->Quadrant_upper_left_and_lower_right                  = html_entity_decode('▚', ENT_NOQUOTES, 'UTF-8');
		$this->Quadrant_upper_left_and_upper_right_and_lower_left   = html_entity_decode('▛', ENT_NOQUOTES, 'UTF-8');
		$this->Quadrant_upper_left_and_upper_right_and_lower_right  = html_entity_decode('▜', ENT_NOQUOTES, 'UTF-8');
		$this->Quadrant_upper_right                                 = html_entity_decode('▝', ENT_NOQUOTES, 'UTF-8');
		$this->Quadrant_upper_right_and_lower_left                  = html_entity_decode('▞', ENT_NOQUOTES, 'UTF-8');
		$this->Quadrant_upper_right_and_lower_left_and_lower_right  = html_entity_decode('▟', ENT_NOQUOTES, 'UTF-8');
	}

	/**
	 * Set DATA
	 * @param array $data
	 */
	public function set_data(array $data)
	{
		$this->data = $data;
		$this->count_data = count($this->data);
		$this->max_value = max($this->data);
		$this->min_value = min($this->data);
		$this->data_width = $this->count_data * $this->config['bar_width'];
	}

	/**
	 * Set array of id's visibles even the value is 0
	 * Array with the id's even the value is 0 and cannot be drawed in graph, but we need to know if there is a min() value in data. Then draw it with Lower_one_eighth_block
	 * @param array $arr_id_data_visible
	 */
	public function set_arr_id_data_visible(array $ids)
	{
		$this->arr_id_data_visible = $ids;
	}

	/**
	 * Set SHOW X,Y AXIS TITLE
	 * @param boolean $show_axis_titles
	 */
	public function set_show_axis_titles(bool $show_axis_titles = true)
	{
		$this->set_show_x_axis_title($show_axis_titles);
		$this->set_show_y_axis_title($show_axis_titles);
	}

	/**
	 * Set PADDING
	 * @param integer $padding
	 */
	public function set_padding(int $padding = 1)
	{
		$this->config['left_padding'] = $padding;
		$this->config['right_padding'] = $padding;
		$this->config['top_padding'] = $padding;
		$this->config['bottom_padding'] = $padding;
	}

	/**
	 * Set CONFIG
	 * @param array $config
	 */
	public function set_config(array $config)
	{
		$this->config = array_merge($this->config, $config);
	}

	/**
	 * Get Str chars of down X axis border
	 * @return string $border
	 */
	private function get_down_border()
	{
		$border_cfg = $this->border_chars[$this->config['border_chars']];

		$chr_corner = html_entity_decode($border_cfg['bottom-left'], ENT_NOQUOTES, 'UTF-8');
		$chr_line   = html_entity_decode($border_cfg['bottom'], ENT_NOQUOTES, 'UTF-8');

		return $chr_corner.str_repeat($chr_line, $this->data_width + 2); // +2 free space left & right
	}

	/**
	 * Get Str chars of up X axis border
	 * @return string $border
	 */
	private function get_up_border()
	{
		$chr_corner = ' ';
		$chr_line   = '_';
		return $chr_corner.str_repeat($chr_line, $this->data_width + 2); // +2 = free space left and right
	}

	/**
	 * Justify axis values
	 */
	private function justify(array $vals, int $offset = 0)
	{
		$limit = $this->data_width + 4 + $offset;
		$s = trim(implode(" ", $vals));
		$l = strlen($s);

		if($l >= $limit){
			$ret = wordwrap($s, $limit);
		} else {
			$c = count($vals) - 1;
			$h = ceil(($limit - $l) / $c);
			$ret = str_replace(' ', str_repeat(' ', $h), $s);
		}

		return $ret;
	}

	/**
	 * Prepare Graph Lines
	 */
	private function prepare_graph_lines()
	{
		$this->arr_prepare_output = [];

		for($i = 0; $i < $this->count_data; $i++){
			$full = (int)($this->data[$i] * $this->config['graph_length'] / $this->max_value);
			$empty = $this->config['graph_length'] - $full;

			$strPrepare = '';

			if($full > 0){
				$strPrepare .= str_repeat('1', $full);
			}

			if($empty > 0){
				$strPrepare .= str_repeat('0', $empty);
			}

			$this->arr_prepare_output[] = $strPrepare;
		}
	}

	/**
	 * Get Graph Line
	 * @param integer $id_line (begin 0 with top line graph)
	 * @param integer $low_limit
	 * @param integer $high_limit
	 * @return string str_line
	 */
	private function get_graph_line($id_line, $low_limit, $high_limit)
	{
		$str_line = '';
		$explain = $this->config['explain_values'];
		$bar_width = $this->config['bar_width'];
		$graph_length = $this->config['graph_length'];
		$bar_color = $this->text_colors[$this->config['bar_color']];
		$chr_underlines = ($this->config['draw_underlines'] && (($id_line+1) % $this->config['underlines_every'] == 0)) ? '_' : ' ';

		foreach($this->data as $key => $data){
			if($this->arr_prepare_output[$key][$graph_length - $id_line-1]=='1'){
				$str_line .= chr(27);
				if($explain && ($data < $low_limit || $data > $high_limit)){
					$str_line .= $this->text_colors['red'];
				} else {
					$str_line .= $bar_color;
				}
				$str_line .= str_repeat($this->Full_block, $bar_width-1);
				//Quadrant_lower_left
				$str_line .= $this->Left_half_block;
				$str_line .= chr(27).'[0m';
			} else {
				if($graph_length - 1 == $id_line && in_array($key, $this->arr_id_data_visible)){
					// We need to draw someting to show the value exists, unless is 0
					$str_line .= str_repeat($this->Lower_half_block, $bar_width-1);
					$str_line .= $this->Lower_half_block; //$this->Quadrant_lower_left; // dont work ????
				} else {
					$str_line .= str_repeat($chr_underlines, $bar_width);  // Fill with graph char code of ' '
				}
			}
		}

		return $str_line;
	}

	private function prepare_line_format()
	{
		// Blank space of left values
		$str_blank_left_values = str_repeat(' ', strlen($this->max_value));

		// Blank char for title Axis Y
		// One space for the title & other for separate from 'Axis Y' values
		$str_char_title_y = ($this->config['show_y_axis_title']) ? '  ' : ''; 
		$str_padding_left = str_repeat(' ', $this->config['padding_left']);

		$this->padding_left = $str_padding_left.$str_char_title_y.$str_blank_left_values;
		$this->padding_right = str_repeat(' ', $this->config['padding_right']);
	}

	private function line_format($string, $add_left = '')
	{
		 $this->arr_output[] = $this->padding_left.$add_left.$string.$this->padding_right;
	}

	private function line_format_custom($left, $string)
	{
		$this->arr_output[] = $left.$string.$this->padding_right;
	}

	private function default_padded($string)
	{
		// +1 = vertical col axis separator, +2 = free space left and right
		return str_pad($string, $this->data_width + 3, ' ', STR_PAD_BOTH);
	}

	private function calc_average()
	{
		$sum = array_sum($this->data);
		$avg = $sum / $this->count_data;
		$sum_median = 0;

		for($i=0; $i < $this->count_data; $i++){
			$substract = $this->data[$i] - $avg;
			$sum_median += $substract * $substract; // pow($substract, 2);
		}

		$vari = $sum_median/$this->count_data;
		$std = sqrt($vari);

		return [$avg, $std];
	}

	private function print_explain($avg, $std, $high_limit, $low_limit)
	{
		$sum = $avg * $this->count_data;
		$arr_sort = $this->data;
		$pos_median = ($this->count_data + 1) / 2;
		sort($arr_sort, SORT_NUMERIC);
		$median = (double)((($this->count_data % 2 != 0)) ? $arr_sort[$pos_median - 1] : ($arr_sort[$pos_median - 1] + $arr_sort[$pos_median]) / 2);
		$vari = $std * $std;

		$arr_explain = [
			'Max '.$this->max_value,
			'Min '.$this->min_value,
			'Sum '.number_format($sum, 2, '.', ''),
			'Avg '.number_format($avg, 2, '.', ''),
			'Median '.number_format($median, 2, '.', ''),
			'Vari '.number_format($vari, 2, '.', ''),
			'Std Dsv '.number_format($std, 2, '.', ''),
			'O ^ Lim '.number_format($high_limit, 2, '.', ''),
			'O v Lim '.number_format($low_limit, 2, '.', '')
		];

		if($this->config['explain_values_same_line']){
			// For compatibility with other functions, we need to cut the line if overrides de width capacity
			$str_cutted = str_pad(implode(', ', $arr_explain), $this->data_width + 2, ' ', STR_PAD_RIGHT);
			if(strlen($str_cutted) > $this->data_width + 2){
				$str_cutted = substr($str_cutted, 0, $this->data_width + 1);
				$str_cutted .= chr(27).'[0;31m'.'>'.chr(27).'[0m'.' '; // Indicate that the values continue
			}
			$this->line_format(' '.$str_cutted);
		} else {
			foreach($arr_explain as $explain){
				$this->line_format(' '.str_pad($explain, $this->data_width + 2, ' ', STR_PAD_RIGHT));
			}
		}
	}

	/**
	 * Predict line count
	 */
	public function predict_line_count()
	{
		$count = $this->config['padding_top'] +  $this->config['graph_length'] + $this->config['padding_bottom'] + 4;

		($this->config['draw_underlines']) AND $count++;
		($this->config['show_x_axis_title']) AND $count++;
		($this->config['explain_values'] || $this->config['explain_values_same_line']) AND $count += 9;

		return $count;
	}

	/**
	 * Prepare Output in Array
	 */
	public function prepare_array_output()
	{
		$this->arr_output = [];
		$this->data_width = $this->count_data * $this->config['bar_width']; // just in case bar_width was changed
		$this->prepare_line_format();
		list($avg, $std) = $this->calc_average();
		$high_limit = $avg + $std * $this->config['outlier_factor'];
		$low_limit = $avg - $std * $this->config['outlier_factor'];
		$this->prepare_graph_lines();

		// Padding Top
		for($i = $this->config['padding_top']; $i > 0; $i--){
			$this->line_format($this->default_padded(''));
		}
		// Graph Title
		$this->line_format($this->default_padded($this->config['title']));

		// Down border line
		$draw_underlines = $this->config['draw_underlines'];
		if($draw_underlines){
			$this->line_format($this->get_up_border());
		}

		// Axis X Title
		$show_y_axis_title = $this->config['show_y_axis_title'];
		if($show_y_axis_title){
			$str_pad_axis_y_title = str_pad($this->config['y_axis_title'], $this->config['graph_length'], ' ', STR_PAD_BOTH);
		}

		$str_padding_left = str_repeat(' ', $this->config['padding_left']);
		$chr_border_left = $this->border_chars[$this->config['border_chars']]['left'];
		$y_blocks = ($this->max_value - $this->min_value) / $this->config['graph_length'];
		$max_y_length = strlen(strval($this->max_value));
		// if is <10, we need to add 1 decimal. Then the strlen is added with decimal separator and one number
		$val_diff_single_digit = ($this->max_value - $this->min_value) < 10;
		($val_diff_single_digit) AND $max_y_length += 2;

		for($i = 0; $i < $this->config['graph_length']; $i++){
			$value_y = $this->max_value - $y_blocks * $i;
			$value_y = ($val_diff_single_digit) ? number_format($value_y, 1, '.', '') : (int)$value_y;
			$value_y = str_pad($value_y, $max_y_length, ' ', STR_PAD_LEFT);
			$str_char_title_y_loop = ($show_y_axis_title) ? $str_pad_axis_y_title[$i].' ' : '';
			$chr_underlines = ($draw_underlines && (($i + 1) % $this->config['underlines_every'] == 0)) ? '_' : ' ';
			$this->line_format_custom($str_padding_left.$str_char_title_y_loop.$value_y.$chr_border_left, $chr_underlines.$this->get_graph_line($i, $low_limit, $high_limit).$chr_underlines);
		}

		// Down border line
		$this->line_format($this->get_down_border());

		// Axis X Separators |
		$this->line_format("  ".$this->justify(array_fill(0, count($this->axis_x_values), "|"), -2)." ");
		// Axis X Values
		$this->line_format(" ".$this->justify($this->axis_x_values));

		// Axis X Title
		if($this->config['show_x_axis_title']){
			// +1 = vertical col axis separator, +2 = free space left and right
			$this->line_format($this->default_padded($this->config['x_axis_title']));
		}

		// Explain Values
		if($this->config['explain_values'] || $this->config['explain_values_same_line']){
			$this->print_explain($avg, $std, $high_limit, $low_limit);
		}

		// Padding Bottom
		$padding_bottom = $this->config['padding_bottom'];
		for($i = $padding_bottom; $i > 0; $i--){
			 // +1 = vertical col axis separator, +2 = free space left and right
			$this->line_format($this->default_padded(''));
		}
	}

	/**
	 * Get count(lines) of graph output
	 * return integer $num_lines
	 */
	public function count_output_lines()
	{
		return count($this->arr_output);
	}

	/**
	 * Draw only 1 line id by $line_id
	 * @param integer $line_id
	 */
	public function draw_line(int $id)
	{
		echo $this->arr_output[$id];
	}

	/**
	 * Draw Graph
	 */
	public function draw()
	{
		$this->prepare_array_output();

		foreach($this->arr_output as $output_line){
			echo $output_line.PHP_EOL;
		}
	}
}
