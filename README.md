# CLI PHP Graph Bars for Machine Learning with Outliers alert
CLI PHP for visualize Machine learning datasets in Graph bar format. Detect Outliers. See your data before Training

## V.1.0.x

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
 You can use the class to display bar charts with all features of colors, formats, ... as standard bar chart. To do it you simply need to hide the data explain the values. Outliers bars will not be drawed in red and will be a standard bar col too. explain_values is part of the config options.
 
  # NOTE ABOUT OUTLIER FACTOR:
 The class has a variable with the outlier_factor. There is no trivial solution for x, but usually, a value between 2 and 4 seems practical. outlier_factor is part of the config options.
 
 
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
         $config = ['title' => 'Months in %'];
         $bar_graph = new cli_graph_ml( $arr_val_example_1, $axis_x_values , $config);
         $bar_graph->draw();


- **CHANGE CONFIGURATION:**

You can change the bar graph when you want

*set_config( $arr_values  );*

Example:

         $config = [
                'graph_length'  => 10,
                'bar_color'  => 'lightwhite'
                ];
                
         $bar_graph->set_config( $config );


 **Of course. You can use it freely :vulcan_salute::alien:**
 
 By Rafa.
 
 
 @author Rafael Martin Soto
 
 @author {@link http://www.inatica.com/ Inatica}
 
 @blog {@link https://rafamartin10.blogspot.com/ Rafael Martin's Blog}
 
 @since SEPTEMBER 2021
 
 @version 1.0.x
 
 @license GNU General Public License v3.0
