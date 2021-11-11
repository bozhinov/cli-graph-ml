# CLI PHP Graph Bars for Machine Learning with Outliers alert
CLI PHP for visualize Machine learning datasets in Graph bar format. Detect Outliers. See your data before Training

## V.1.0.2

Before training processes at Deep Learning, the most hard work is to have a good datasets in its structure. Always we need to check the datasets before and if we see the data in graphs bars is more easy to detect outliers. This php class helps you to detect it with a shortest time. The class alert you about outliers with Red Bars.

You can use it to display standard bar graphs too.

The bar graphs are customizable in:
- Colors
- Background guidelines
- Padding
- Titles
- Height
- Show/Hide data information

# SCREENSHOTS:
![Screenshot of 3 float bar charts in CLI PHP environtment](https://github.com/vivesweb/cli-graph-ml/blob/main/bar-multi-graph-cli-php.png?raw=true)
Screenshot of 3 float bar charts in CLI PHP environtment


![Screenshot of custom bar charts in CLI PHP environtment](https://github.com/vivesweb/cli-graph-ml/blob/main/bar-graph-cli-php.png?raw=true)
Screenshot of custom bar charts in CLI PHP environtment
 
 # REQUERIMENTS:
 
 - PHP 7.2
 
 
  # FILES:
 There are 2 basic files:
 
 *cli-graph-ml.class.php* -> **Master class**. This file is the main file that you need to include in your code.
 
 *example.php* -> **example file**
 
 # DO YO WANT DISPLAY STANDARD BAR CHARTS?
 You can use the class to display bar charts with all features of colors, formats, ... as standard bar chart. To do it you simply need to hide the data explain the values.  Outliers bars will not be drawed in red and will be a standard bar col too. See *$bar_graph->set_explain_values( $boolean );* method.
 
  # NOTE ABOUT OUTLIER FACTOR:
 The class has a variable with the outlier_factor. There is no trivial solution for x, but usually, a value between 2 and 4 seems practical. See set_outlier_factor() Method
 
 
 # INSTALLATION:
 A lot of easy :smiley:. It is written in PURE PHP. Only need to include the files. Tested on basic PHP installation
 
         require_once( 'cli-graph-ml.class.php' );
	 
# DATA INFORMATION:
 The system will inform to you about:
 - Max Value
 - Min Value
 - Sum of all Values
 - Average of values
 - Median of values
 - Variance of values
 - Standard Derivation of values
 - Limit Outliers Upper
 - Limit Outliers Down
 - The outliers values will be drawed in RED column bar (See screenshots)
 
 # BASIC USAGE:
 
         $arr_val_example_1 = [  1,2,5,6,7,9,12,15,18,19,38 ];
         $axis_x_values = [ 'Jan', 'Jun', 'Dec' ];
         
         $bar_graph = new cli_graph_ml( $arr_val_example_1, $axis_x_values );
         $bar_graph->set_title( 'Months in %' );
         
         // Draw with defaults
         $bar_graph->draw();
 
 
# RESUME OF METHODS:

- **CREATE CLI-GRAPH-ML:**
 
*$bar_graph= new cli_graph_ml( $arr_val_example_1, $axis_x_values );*

Example:

         $arr_val_example_1 = [  1,2,5,6,7,9,12,15,18,19,38 ];
         $axis_x_values = [ 'Jan', 'Jun', 'Dec' ];
         
         $bar_graph = new cli_graph_ml( $arr_val_example_1, $axis_x_values );


- **SHOW 0 VALUES:**

If you need to teach a value 0 to be visible, you can create an array of column id's where to show the value even if it is 0 to be able to visualize it. In this case, if the field should be visible, half a gray box will be shown, indicating that the value is 0, but that there is

*set_arr_id_data_visible( $arr_id_data_visible )*

Example:

	// Show 0 values con cols id[0] & id[3]
	$arr_id_data_visible = [0, 3];
        $bar_graph->set_arr_id_data_visible($arr_id_data_visible);


        
- **DRAW:**

You can send the result to the screen with this method

*draw( )*

Example:

        $bar_graph->draw();
        
You can draw 1 line of the chart. Is used to concatenate more than 1 chart. See example.php. Then you can set some params more to do it. See example.php for more information and example:
- $line_id; // Id of the line to be drawed.
- $do_line_break = false; // Becouse the PHP_EOL will be done at last chart
- $prepare_array_output = false; // becouse we prepare it previously

Example:

        $bar_graph1->prepare_array_output( );
        $bar_graph2->prepare_array_output( );
        $bar_graph3->prepare_array_output( );
        
        // Draw Line 0 of each graph
        $bar_graph1->draw( 0, false, false);
        $bar_graph2->draw( 0, false, false);
        $bar_graph3->draw( 0, false, false);
        
        echo PHP_EOL; // after 3rth graph
        
        // Draw Line 1 of each graph
        $bar_graph1->draw( 1, false, false);
        $bar_graph2->draw( 1, false, false);
        $bar_graph3->draw( 1, false, false);
        
        echo PHP_EOL; // after 3rth graph
        
        
        // Draw Line 2 of each graph
        $bar_graph1->draw( 2, false, false);
        $bar_graph2->draw( 2, false, false);
        $bar_graph3->draw( 2, false, false);
        
        echo PHP_EOL; // after 3rth graph
        ......
        
- **SET DATA:**

When you create the class, it will be created with $data param, but you can change the data when you want.

*set_data( $arr_data )*

Example:

        $arr_val_example_3 = [  11,22,55,60,70,90,120,150,180,190,380 ];
        $bar_graph->set_data( $arr_val_example_3 );


- **CHANGE CONFIGURATION:**

You can change the bar graph when you want

*set_config( $arr_values  );*

Example:

        
         $config = [
                'graph_length'  => 10,
                'bar_color'  => 'lightwhite'
                ];
                
         $bar_graph->set_config( $config );



- **BEFORE DRAW, THE SYSTEM NEED TO PREPARE THE OUTPUT. WITH DRAW() IS CALLED AUTOMATICALLY, BUT YOU CAN TO PREPARE OUTSIDE. SEE EXAMPLE.PHP:**

*prepare_array_output(  )*

Example:

        
         $bar_graph->prepare_array_output( );



- **GET THE NUMBER OF LINES BEFORE THE OUTPUT:**

With next methods you will need to know the numer of lines before de output.

*count_output_lines(  )*

Example:

        $count_output_lines = $bar_graph->count_output_lines();
	

 **Of course. You can use it freely :vulcan_salute::alien:**
 
 By Rafa.
 
 
 @author Rafael Martin Soto
 
 @author {@link http://www.inatica.com/ Inatica}
 
 @blog {@link https://rafamartin10.blogspot.com/ Rafael Martin's Blog}
 
 @since SEPTEMBER 2021
 
 @version 1.0.0
 
 @license GNU General Public License v3.0
