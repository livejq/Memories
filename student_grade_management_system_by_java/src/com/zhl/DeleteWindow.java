package com.zhl;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;
import java.sql.SQLException;
import javax.swing.*;

public class DeleteWindow extends JPanel implements ActionListener,KeyListener{
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	JLabel [] labels;
	String [] labelNames={"输入要删除信息的学号：","姓名：","性别：","学院：","专业：","班级："};
	JTextField numberField,nameField,schoolField,classField,sexField,majorField;
	JButton deleteButton,resetButton,queryButton;
	DBConnection dbc;
	
     
	public void init(){
		Font labelFont=new Font("宋体",Font.PLAIN ,20);
		labels=new JLabel[6];
		for(int i=0;i<6;i++){
			labels[i]=new JLabel(labelNames[i],JLabel.CENTER );
			labels[i].setFont(labelFont);
			
		}
		numberField = new JTextField(12);
		numberField.addKeyListener(this);
		queryButton = new JButton("查询");
		queryButton.setFont(labelFont);
		numberField.setFont(labelFont);
		queryButton.addActionListener(this);
		queryButton.addKeyListener(this);
		
		
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
		
		deleteButton = new JButton("删除");
		deleteButton.setFont(labelFont);
		deleteButton.addActionListener(this);
		resetButton = new JButton("重置");
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
		buttonPanel.add(deleteButton);
		buttonPanel.add(resetButton);
		
		
		
		this.setLayout(new BorderLayout());
		this.add(centerPanel,BorderLayout.CENTER);
		this.add(buttonPanel,BorderLayout.SOUTH);
	}
	public DeleteWindow(){
		init();
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
			else if(arg0.getActionCommand().equals("删除")){
				try {
					if(dbc==null||dbc.getCon()==null||dbc.con.isClosed()) {
						dbc = new DBConnection();
					}
				} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
				//根据输入的学号将学生信息从数据表student中删除
				int n=JOptionPane.showConfirmDialog(this,"您确定要删除此学生的全部信息？",
						"删除提示",JOptionPane.YES_NO_OPTION);
				if(n==JOptionPane.YES_OPTION) {
					String strs=numberField.getText();
					if(dbc.deleteRecord(strs)) {
							JOptionPane.showMessageDialog(this,"删除成功！",
									"删除提示",JOptionPane.PLAIN_MESSAGE);
							numberField.requestFocus();
							numberField.setText("");
						
					}else {
							JOptionPane.showMessageDialog(this,"删除失败！",
									"删除提示",JOptionPane.ERROR_MESSAGE);
				}
			}
				dbc.close();
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

