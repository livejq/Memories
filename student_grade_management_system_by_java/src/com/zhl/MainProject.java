package com.zhl;
import java.awt.*;
import java.awt.event.*;
import javax.swing.*;

public class MainProject extends JFrame implements ActionListener{
	
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	JMenuBar menubar;
	JMenu menu;  
	JMenuItem[] menuitems;
	JLabel label;
	JPanel panel;
	String[] menuitemsnames = {"录入学生信息","修改学生信息"
			,"查询学生信息","删除学生信息","查看所有学生信息"};
	CardLayout cardlayout;
	InputWindow inputWindow;
	ModifyWindow modifyWindow;
	SearchWindow searchWindow;
	DeleteWindow deleteWindow;
	TableWindow tableWindow;
	
	public MainProject(){
		init();
		setLocation(300,20);
		setSize(850,650);
		setVisible(true);
		this.setDefaultCloseOperation(DISPOSE_ON_CLOSE);
	}
	
	public void init(){
		menubar = new JMenuBar();
		menu = new JMenu("操作菜单");
		menu.setFont(new Font("Serif",Font.PLAIN ,22));//Font类???
		menuitems = new JMenuItem[5];
		
		menuitems[0] = new JMenuItem(menuitemsnames[0],new ImageIcon("input.png"));
		menuitems[1] = new JMenuItem(menuitemsnames[1],new ImageIcon("alter.png"));	
		menuitems[2] = new JMenuItem(menuitemsnames[2],new ImageIcon("search.png"));
		menuitems[3] = new JMenuItem(menuitemsnames[3],new ImageIcon("delete.png"));
		menuitems[4] = new JMenuItem(menuitemsnames[4],new ImageIcon("see.png"));
		
		for(int i=0;i<5;i++){
			menuitems[i].setFont(new Font("宋体",Font.PLAIN ,18));
			menuitems[i].addActionListener(this);//注册监听器
			menu.add(menuitems[i]);
		}
				
		menubar.add(menu);
		setJMenuBar(menubar);
		panel = new JPanel();
		cardlayout = new CardLayout();
		label = new JLabel("欢迎进入学生管理系统",JLabel.CENTER);
		label.setFont((new Font("隶书",Font.PLAIN ,40)));
		label.setForeground(Color.black);
		panel.setLayout(cardlayout);//要与选项卡相区别（JTebbedPane）
		panel.add("welcome",label);
		
		inputWindow = new InputWindow();
		panel.add("inputWindow",inputWindow);
		
		modifyWindow = new ModifyWindow();
		panel.add("modifyWindow",modifyWindow);
		
		searchWindow = new SearchWindow();
		panel.add("searchWindow",searchWindow);
		
		deleteWindow = new DeleteWindow();
		panel.add("deleteWindow",deleteWindow);
		
		tableWindow = new TableWindow();
		panel.add("tableWindow",tableWindow);
		
		panel.setBackground(Color.white);
		add(panel,BorderLayout.CENTER);//??？
	}
	public static void main(String[] args) {
		new MainProject();

	}

	@Override
	public void actionPerformed(ActionEvent arg0) {
		
		if(arg0.getActionCommand().equals("录入学生信息")){
			cardlayout.show(panel,"inputWindow");
			inputWindow.numberField.requestFocusInWindow();
		}
		
		else if(arg0.getActionCommand().equals("修改学生信息")){
			cardlayout.show(panel,"modifyWindow");
			modifyWindow.numberField.requestFocusInWindow();
		}
		
		else if(arg0.getActionCommand().equals("查询学生信息")){
			cardlayout.show(panel,"searchWindow");     
			searchWindow.numberField.requestFocusInWindow();
		}
		
		else if(arg0.getActionCommand().equals("删除学生信息")){
			cardlayout.show(panel,"deleteWindow");
			deleteWindow.numberField.requestFocusInWindow();
		}
		
		else if(arg0.getActionCommand().equals("查看所有学生信息")){
			tableWindow = new TableWindow();
			panel.add("tableWindow",tableWindow);
			cardlayout.show(panel,"tableWindow");
		}
	}
}
