package com.zhl;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.ItemEvent;
import java.awt.event.ItemListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;
import java.sql.SQLException;
import javax.swing.*;

public class ModifyWindow extends JPanel implements ItemListener,ActionListener,KeyListener{
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	JLabel [] labels;
	String [] labelNames={"输入要修改信息的学号：","(新)姓名：","(新)性别：","(新)学院：","(新)专业：","(新)班级："};
	JTextField numberField,nameField,classField;
	JRadioButton maleRadiobutton,femaleRadiobutton;
	JComboBox<String> schoolCombo,majorCombo;
	String [] schoolName={"信息与通信工程学院","轮机工程学院","外语学院","经贸学院"},majorName[]={{"软件技术","电子商务","计算机科学与技术","通信工程","电子信息工程"},{"轮机工程","电子电气工程",},{"商务英语","旅游管理"},{"国际商务","国际贸易"}};
	String regex = "^[\u4e00-\u9fa5]{0,4}";//与中文相匹配（限制输入，中文名字最多长度为4）
	JButton modifyButton,resetButton,queryButton;
	DBConnection dbc;
     
	public void init(){
		Font labelFont=new Font("宋体",Font.PLAIN ,20);
		labels=new JLabel[6];
		for(int i=0;i<6;i++){
			labels[i]=new JLabel(labelNames[i],JLabel.CENTER );
			labels[i].setFont(labelFont);
			
		}
		numberField=new JTextField(12);
		queryButton=new JButton("查询");
		queryButton.addActionListener(this);
		queryButton.addKeyListener(this);
		queryButton.setFont(labelFont);
		
		numberField.setFont(labelFont);
		numberField.addKeyListener(this);
		
		nameField=new JTextField(12);
		nameField.setFont(labelFont);
		
		classField=new JTextField(12);
		classField.setFont(labelFont);
		
		ButtonGroup sexGroup=new ButtonGroup();
		maleRadiobutton=new JRadioButton("男",true);
		femaleRadiobutton=new JRadioButton("女");
		maleRadiobutton.setFont(labelFont);
		femaleRadiobutton.setFont(labelFont);
		
		sexGroup.add(maleRadiobutton);
		sexGroup.add(femaleRadiobutton);
		
		schoolCombo=new JComboBox<String>(schoolName);
		schoolCombo.setFont(labelFont);
		schoolCombo.addItemListener(this);//注册监听器
		majorCombo=new JComboBox<String>(majorName[0]);
		majorCombo.setFont(labelFont);
		
		modifyButton=new JButton("修改");
		modifyButton.setFont(labelFont);
		modifyButton.addActionListener(this);
		resetButton=new JButton("重置");
		resetButton.setFont(labelFont);
		resetButton.addActionListener(this);
		
		Box [] horiBoxes=new Box[6];
		for(int i=0;i<6;i++){
			horiBoxes[i]=Box.createHorizontalBox();
			horiBoxes[i].add(labels[i]);
			
		}
		horiBoxes[0].add(numberField);
		horiBoxes[0].add(queryButton);
		horiBoxes[1].add(nameField);
		horiBoxes[2].add(femaleRadiobutton);horiBoxes[2].add(maleRadiobutton);
		horiBoxes[3].add(schoolCombo);
		horiBoxes[4].add(majorCombo);
		horiBoxes[5].add(classField);
		
		Box verticalBox=Box.createVerticalBox();
		for(int i=0;i<6;i++){
			verticalBox.add(horiBoxes[i]);	
			verticalBox.add(Box.createVerticalStrut(15));
		}
		
		JPanel centerPanel=new JPanel();
		centerPanel.add(verticalBox);
		JPanel buttonPanel=new JPanel();
		buttonPanel.add(modifyButton);
		buttonPanel.add(resetButton);
		
		
		
		this.setLayout(new BorderLayout());
		this.add(centerPanel,BorderLayout.CENTER);
		this.add(buttonPanel,BorderLayout.SOUTH);
	}
	public ModifyWindow(){
		init();
	}
	@Override
	public void itemStateChanged(ItemEvent arg0){
		int index=((JComboBox<?>)arg0.getSource()).getSelectedIndex();
		majorCombo.removeAllItems();
		for(String s:majorName[index]){
			majorCombo.addItem(s);
		}
	}

	public  boolean isLegal(String str){
		if(str==null||str.equals("")||str.contains(" "))
			return false;
		return true;
	}
	@Override
	public void actionPerformed(ActionEvent arg0){
		if(arg0.getActionCommand().equals("重置")){
			numberField.setText("");
			nameField.setText("");
			classField.setText("");
		}
		else if(arg0.getActionCommand().equals("查询")){
			 	if(!isLegal(numberField.getText())){
			 		JOptionPane.showMessageDialog(this,"您输入的学号不规范：学号为空或包含空格！",
						"学号非法",JOptionPane.WARNING_MESSAGE);
			 		numberField.requestFocus();
			 		numberField.selectAll();
				
			 	}else if(!numberField.getText().matches("\\d{12}")){
			 		JOptionPane.showMessageDialog(this,"您输入的学号不正确：学号必须由十二位数字构成！",
						"学号非法",JOptionPane.WARNING_MESSAGE);
			 		numberField.requestFocus();
			 		numberField.selectAll();
			 	}
			 	else {
			 		try {
						if(dbc==null||dbc.getCon()==null||dbc.con.isClosed()) {
							dbc = new DBConnection();
						}
					} catch (SQLException e) {
						// TODO Auto-generated catch block
						e.printStackTrace();
					}
			 		if(!dbc.findByNumber(numberField.getText())) {
			 			JOptionPane.showMessageDialog(this,"您输入的学号不存在，请重新输入！",
							"学号重复",JOptionPane.ERROR_MESSAGE);
			 			numberField.requestFocus();
			 			numberField.selectAll();
			 		}
			 		else {
			 			JOptionPane.showMessageDialog(this,"存在此学号！",
								"学号存在",JOptionPane.PLAIN_MESSAGE);
			 			
			 			String[] array=dbc.selectRecord(numberField.getText());
						nameField.setText(array[1]);
						if(array[2].equals("男")){
							maleRadiobutton.setSelected(true);
						
						}
						else {
							femaleRadiobutton.setSelected(true);
						}
						schoolCombo.setSelectedItem(array[3]);;
						majorCombo.setSelectedItem(array[4]);
						classField.setText(array[5]);
			 		}
			 	}	
		
		}
		else if(arg0.getActionCommand().equals("修改")){
				try {
					if(dbc==null||dbc.getCon()==null||dbc.con.isClosed()) {
						dbc = new DBConnection();
						}
					} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
					}
				if(!isLegal(nameField.getText())){
					JOptionPane.showMessageDialog(this,"您输入的姓名不规范：姓名为空或包含空格！",
							"姓名非法",JOptionPane.WARNING_MESSAGE);
					nameField.requestFocus();
					nameField.selectAll();				
				}else if(!nameField.getText().matches(regex)) {
					JOptionPane.showMessageDialog(this,"您输入的姓名不规范：姓名为非中文或中文字数超过4个！",
							"姓名非法",JOptionPane.WARNING_MESSAGE);
					nameField.requestFocus();
					nameField.selectAll();
				}else if(!isLegal(classField.getText())){
					JOptionPane.showMessageDialog(this,"您输入的班级不规范：班级为空或包含空格！",
							"班级非法",JOptionPane.WARNING_MESSAGE);
					classField.requestFocus();
					classField.selectAll();
					}
					
				else{//我结合了已有的插入和删除的函数，没有重新根据Update语句重新写一个函数
						int n=JOptionPane.showConfirmDialog(this,"您确定要修改？",
								"修改提示",JOptionPane.YES_NO_OPTION);
					if(n==JOptionPane.YES_OPTION) {
						String strs=numberField.getText();
							dbc.deleteRecord(strs);
						String sex ="男";
					if(femaleRadiobutton.isSelected())sex ="女";
						String news[]={numberField.getText(),nameField.getText(),sex,(String)schoolCombo.getSelectedItem(),
								(String)majorCombo.getSelectedItem(),classField.getText()};
					if(dbc.insertRecord(news)) {
						JOptionPane.showMessageDialog(this,"您修改的学生信息成功！",
								"修改提示",JOptionPane.PLAIN_MESSAGE);
						numberField.setText("");
						nameField.setText("");
						classField.setText("");
						
					}else {
						JOptionPane.showMessageDialog(this,"您修改的学生信息失败！",
								"修改提示",JOptionPane.ERROR_MESSAGE);
					}
				}	
			}
				dbc.close();	
		}
	}
	
	@Override
	public void keyPressed(KeyEvent args0) {
		if(numberField.getCaretPosition()>=11) 
			numberField.transferFocus();
		if(args0.getKeyCode()==KeyEvent.VK_ENTER) {
			if(!isLegal(numberField.getText())){
		 		JOptionPane.showMessageDialog(this,"您输入的学号不规范：学号为空或包含空格！",
					"学号非法",JOptionPane.WARNING_MESSAGE);
		 		numberField.requestFocus();
		 		numberField.selectAll();
			
		 	}else if(!numberField.getText().matches("\\d{12}")){
		 		JOptionPane.showMessageDialog(this,"您输入的学号不正确：学号必须由十二位数字构成！",
					"学号非法",JOptionPane.WARNING_MESSAGE);
		 		numberField.requestFocus();
		 		numberField.selectAll();
		 	}
		 	else {
		 		try {
					if(dbc==null||dbc.getCon()==null||dbc.con.isClosed()) {
						dbc = new DBConnection();
					}
				} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
		 		if(!dbc.findByNumber(numberField.getText())) {
		 			JOptionPane.showMessageDialog(this,"您输入的学号不存在，请重新输入！",
						"学号重复",JOptionPane.ERROR_MESSAGE);
		 			numberField.requestFocus();
		 			numberField.selectAll();
		 		}
		 		else {
		 			JOptionPane.showMessageDialog(this,"存在此学号！",
							"学号存在",JOptionPane.PLAIN_MESSAGE);
		 			
		 			String[] array=dbc.selectRecord(numberField.getText());
					nameField.setText(array[1]);
					if(array[2].equals("男")){
						maleRadiobutton.setSelected(true);
					
					}
					else {
						femaleRadiobutton.setSelected(true);
					}
					schoolCombo.setSelectedItem(array[3]);;
					majorCombo.setSelectedItem(array[4]);
					classField.setText(array[5]);
		 		}
		 	}	
		}
			
		}
	@Override
	public void keyReleased(KeyEvent arg0) {
		// TODO Auto-generated method stub
		
	}
	@Override
	public void keyTyped(KeyEvent arg0) {
		// TODO Auto-generated method stub
		
	}
}	

