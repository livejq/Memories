package com.zhl;
import java.awt.*;
import javax.swing.*;
import java.sql.SQLException;
import javax.swing.table.DefaultTableModel;
import javax.swing.table.JTableHeader;
import javax.swing.table.TableColumn;
public class TableWindow extends JPanel {
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	JTable table;
	DefaultTableModel dtm;
	Object[] heads= {"学号","姓名","性别",
			"学院","专业","班级"};
	String tablemessages[][];
	DBConnection dbc;
	
	public void init() {
		
			Font tableFont=new Font("行楷",Font.PLAIN ,18);
		
		try {
			if(dbc==null||dbc.getCon()==null||dbc.con.isClosed()) {
					dbc = new DBConnection();
				}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
				tablemessages = dbc.getTableMassage();
				dtm = new DefaultTableModel(tablemessages,heads);
				JTable table = new JTable(dtm);
				dbc.close();
		//dtm.getDataVector().removeAllElements();
		//table.setPreferredScrollableViewportSize(new Dimension(850,650));
		table.setEnabled(false);
		table.setRowHeight(30);
		table.setGridColor(Color.BLACK);
		table.setFont(tableFont);
		TableColumn firthColumn = table.getColumnModel().getColumn(0);firthColumn.setPreferredWidth(10);
		TableColumn secondColumn = table.getColumnModel().getColumn(1);secondColumn.setPreferredWidth(5);
		TableColumn thirdColumn = table.getColumnModel().getColumn(2);thirdColumn.setPreferredWidth(5);
		TableColumn fourthColumn = table.getColumnModel().getColumn(3);fourthColumn.setMinWidth(45);
		TableColumn fifthColumn = table.getColumnModel().getColumn(4);fifthColumn.setPreferredWidth(40);
		TableColumn sixthColumn = table.getColumnModel().getColumn(5);sixthColumn.setPreferredWidth(10);
		
		JTableHeader head = table.getTableHeader();
		
		head.setFont(new Font("楷体",Font.PLAIN,22));
		head.setReorderingAllowed(false);
		head.setResizingAllowed(false);
		
		JScrollPane tablePanel = new JScrollPane(table);
		this.setLayout(new BorderLayout());
		this.add(tablePanel,BorderLayout.CENTER);
		
	}
	
	
	public TableWindow() {
		init();
		
	}

}
