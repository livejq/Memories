package com.zhl;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;
import java.sql.SQLException;
import javax.swing.*;


public class SearchWindow extends JPanel implements ActionListener,KeyListener{
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	JLabel [] labels;
	String [] labelNames={"输入要查询信息的学号：","姓名：","性别：","学院：","专业：","班级："};
	JTextField numberField,nameField,schoolField,classField,sexField,majorField;
	JButton queryButton;
	DBConnection dbc;
     
	public void init(){
		Font labelFont=new Font("宋体",Font.PLAIN ,20);
		labels=new JLabel[6];
		for(int i=0;i<6;i++){
			labels[i]=new JLabel(labelNames[i],JLabel.CENTER );
			labels[i].setFont(labelFont);
			
		}
		numberField = new JTextField(12);
		queryButton = new JButton("查询");
		queryButton.addActionListener(this);
		queryButton.addKeyListener(this);
		queryButton.setFont(labelFont);
		numberField.setFont(labelFont);
		numberField.addKeyListener(this);
		
		nameField = new JTextField(12);
		nameField.setFont(labelFont);
		nameField.setEditable(false);
		
		sexField = new JTextField(12);
		sexField.setFont(labelFont);
		sexField.setEditable(false);
		
		schoolField = new JTextField(12);
		schoolField.setFont(labelFont);
		schoolField.setEditable(false);
		
		majorField = new JTextField(12);
		majorField.setFont(labelFont);
		majorField.setEditable(false);
		
		classField = new JTextField(12);
		classField.setFont(labelFont);
		classField.setEditable(false);
		
		Box [] horiBoxes=new Box[6];
		for(int i=0;i<6;i++){
			horiBoxes[i]=Box.createHorizontalBox();
			horiBoxes[i].add(labels[i]);
			
		}
		horiBoxes[0].add(numberField);
		horiBoxes[0].add(queryButton);
		horiBoxes[1].add(nameField);
		horiBoxes[2].add(sexField);
		horiBoxes[3].add(schoolField);
		horiBoxes[4].add(majorField);
		horiBoxes[5].add(classField);
		
		Box verticalBox=Box.createVerticalBox();
		for(int i=0;i<6;i++){
			verticalBox.add(horiBoxes[i]);	
			verticalBox.add(Box.createVerticalStrut(15));
		}
		
		JPanel centerPanel = new JPanel();
		centerPanel.add(verticalBox);
		JPanel buttonPanel = new JPanel();
		
		this.setLayout(new BorderLayout());
		this.add(centerPanel,BorderLayout.CENTER);
		this.add(buttonPanel,BorderLayout.SOUTH);
	}
	public SearchWindow(){
		init();
	}
	
	public  boolean isLegal(String str){
		if(str==null||str.equals("")||str.contains(" "))
			return false;
		return true;
	}
	
	@Override
	public void actionPerformed(ActionEvent arg0){
	
		 if(arg0.getActionCommand().equals("查询")){
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
			}else{
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
						"学号错误",JOptionPane.ERROR_MESSAGE);
					numberField.requestFocus();
					numberField.selectAll();
					}
				else {
					String strs=numberField.getText();
					String messages[]=dbc.getMessage(strs);
					nameField.setText(messages[0]);
					sexField.setText(messages[1]);
					schoolField.setText(messages[2]);
					majorField.setText(messages[3]);
					classField.setText(messages[4]);
					
				}
				dbc.close();
			}		
		}
	}
	@Override
	public void keyPressed(KeyEvent arg0) {
		if(numberField.getCaretPosition()>=11) 
			numberField.transferFocus();
		if(arg0.getKeyCode()==KeyEvent.VK_ENTER) {
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
			}else{
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
						"学号错误",JOptionPane.ERROR_MESSAGE);
					numberField.requestFocus();
					numberField.selectAll();
					
					}
				else {
					String strs=numberField.getText();
					String messages[]=dbc.getMessage(strs);
					nameField.setText(messages[0]);
					sexField.setText(messages[1]);
					schoolField.setText(messages[2]);
					majorField.setText(messages[3]);
					classField.setText(messages[4]);
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


