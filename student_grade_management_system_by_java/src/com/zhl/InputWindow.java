package com.zhl;
import javax.swing.*;
import java.awt.*;
import java.sql.SQLException;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.FocusEvent;
import java.awt.event.FocusListener;
import java.awt.event.ItemEvent;
import java.awt.event.ItemListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;

public class InputWindow extends JPanel implements ItemListener,ActionListener,KeyListener,FocusListener{
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	JLabel [] labels;
	String [] labelNames={"学号：","姓名：","性别：","学院：","专业：","班级："};
	JTextField numberField,nameField,classField;
	JRadioButton maleRadiobutton,femaleRadiobutton;
	JComboBox<String> schoolCombo,majorCombo;
	String [] schoolName={"信息与通信工程学院","轮机工程学院","外语学院","经贸学院"},majorName[]={{"软件技术","电子商务","计算机科学与技术","通信工程","电子信息工程"},{"轮机工程","电子电气工程",},{"商务英语","旅游管理"},{"国际商务","国际贸易"}};
	String regex = "^[\u4e00-\u9fa5]{0,4}";//与中文相匹配（限制输入，中文名字最多长度为4）
	int count=0;
	JButton inputButton,resetButton;
	DBConnection dbc;
     
	public void init(){
		Font labelFont=new Font("宋体",Font.PLAIN ,20);
		labels=new JLabel[6];
		for(int i=0;i<6;i++){
			labels[i]=new JLabel(labelNames[i],JLabel.CENTER );
			labels[i].setFont(labelFont);
			
		}
		numberField=new JTextField(20);
		numberField.setFont(labelFont);
		numberField.addKeyListener(this);
		
		nameField=new JTextField(20);
		nameField.setFont(labelFont);
		nameField.addKeyListener(this);
		nameField.addFocusListener(this);
		classField=new JTextField(20);
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
		
		inputButton=new JButton("录入");
		inputButton.setFont(labelFont);
		resetButton=new JButton("重置");
		resetButton.setFont(labelFont);
		inputButton.addActionListener(this);
		resetButton.addActionListener(this);
		
		Box [] horiBoxes=new Box[6];
		for(int i=0;i<6;i++){
			horiBoxes[i]=Box.createHorizontalBox();
			horiBoxes[i].add(labels[i]);
			
		}
		horiBoxes[0].add(numberField);
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
		buttonPanel.add(inputButton);
		buttonPanel.add(resetButton);
		
		this.setLayout(new BorderLayout());
		this.add(centerPanel,BorderLayout.CENTER);
		this.add(buttonPanel,BorderLayout.SOUTH);
		
		dbc = new DBConnection();
	}
	public InputWindow(){
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
			nameField.setText("");
			classField.setText("");
			numberField.setText("");
		}
		
		else if(arg0.getActionCommand().equals("录入")){
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
			}else if(!isLegal(nameField.getText())){
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
		}else{
				try {
					if(dbc==null||dbc.getCon()==null||dbc.con.isClosed()) 
						dbc = new DBConnection();
				} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
			if(dbc.findByNumber(numberField.getText())) {
				JOptionPane.showMessageDialog(this,"您输入的学号已存在，请重新输入！",
						"学号重复",JOptionPane.ERROR_MESSAGE);
				numberField.requestFocus();
				numberField.setText("");
			}else{//将输入的学生信息插入数据表student
				String sex ="男";
				if(femaleRadiobutton.isSelected())sex ="女";
				String[] strs = {numberField.getText(),nameField.getText(),sex,(String)schoolCombo.getSelectedItem(),
						(String)majorCombo.getSelectedItem(),classField.getText()};
				if(dbc.insertRecord(strs)) {
					JOptionPane.showMessageDialog(this,"您插入的学生信息成功！",
							"插入提示",JOptionPane.PLAIN_MESSAGE);
					numberField.requestFocus();
					numberField.setText("");
					nameField.setText("");
					classField.setText("");
					
				}else {
					JOptionPane.showMessageDialog(this,"您插入的学生信息失败！",
							"插入提示",JOptionPane.ERROR_MESSAGE);
				}
			}
			dbc.close();
		}
	}
}
	@Override
	public void focusGained(FocusEvent args0) {
		JTextField text = (JTextField)args0.getSource();
		text.setText("");
	}
	@Override
	public void focusLost(FocusEvent arg0) {
		// TODO Auto-generated method stub
		
	}
	@Override
	public void keyPressed(KeyEvent args0) {
		if(numberField.getCaretPosition()>=11) 
			numberField.transferFocus();
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