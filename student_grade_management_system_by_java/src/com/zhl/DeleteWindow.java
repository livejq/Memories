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
	String [] labelNames={"����Ҫɾ����Ϣ��ѧ�ţ�","������","�Ա�","ѧԺ��","רҵ��","�༶��"};
	JTextField numberField,nameField,schoolField,classField,sexField,majorField;
	JButton deleteButton,resetButton,queryButton;
	DBConnection dbc;
	
     
	public void init(){
		Font labelFont=new Font("����",Font.PLAIN ,20);
		labels=new JLabel[6];
		for(int i=0;i<6;i++){
			labels[i]=new JLabel(labelNames[i],JLabel.CENTER );
			labels[i].setFont(labelFont);
			
		}
		numberField = new JTextField(12);
		numberField.addKeyListener(this);
		queryButton = new JButton("��ѯ");
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
		
		deleteButton = new JButton("ɾ��");
		deleteButton.setFont(labelFont);
		deleteButton.addActionListener(this);
		resetButton = new JButton("����");
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
		
		if(arg0.getActionCommand().equals("����")){
			numberField.setText("");
		}
		
		else if(arg0.getActionCommand().equals("��ѯ")){
			if(!isLegal(numberField.getText())){
				JOptionPane.showMessageDialog(this,"�������ѧ�Ų��淶��ѧ��Ϊ�ջ�����ո�",
						"ѧ�ŷǷ�",JOptionPane.WARNING_MESSAGE);
				numberField.requestFocus();
				numberField.selectAll();
				
			}else if(!numberField.getText().matches("\\d{12}")){
				JOptionPane.showMessageDialog(this,"�������ѧ�Ų���ȷ��ѧ�ű�����ʮ��λ���ֹ��ɣ�",
						"ѧ�ŷǷ�",JOptionPane.WARNING_MESSAGE);
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
					JOptionPane.showMessageDialog(this,"�������ѧ�Ų����ڣ����������룡",
						"ѧ�Ŵ���",JOptionPane.ERROR_MESSAGE);
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
			else if(arg0.getActionCommand().equals("ɾ��")){
				try {
					if(dbc==null||dbc.getCon()==null||dbc.con.isClosed()) {
						dbc = new DBConnection();
					}
				} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
				//���������ѧ�Ž�ѧ����Ϣ�����ݱ�student��ɾ��
				int n=JOptionPane.showConfirmDialog(this,"��ȷ��Ҫɾ����ѧ����ȫ����Ϣ��",
						"ɾ����ʾ",JOptionPane.YES_NO_OPTION);
				if(n==JOptionPane.YES_OPTION) {
					String strs=numberField.getText();
					if(dbc.deleteRecord(strs)) {
							JOptionPane.showMessageDialog(this,"ɾ���ɹ���",
									"ɾ����ʾ",JOptionPane.PLAIN_MESSAGE);
							numberField.requestFocus();
							numberField.setText("");
						
					}else {
							JOptionPane.showMessageDialog(this,"ɾ��ʧ�ܣ�",
									"ɾ����ʾ",JOptionPane.ERROR_MESSAGE);
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
				JOptionPane.showMessageDialog(this,"�������ѧ�Ų��淶��ѧ��Ϊ�ջ�����ո�",
						"ѧ�ŷǷ�",JOptionPane.WARNING_MESSAGE);
				numberField.requestFocus();
				numberField.selectAll();
				
			}else if(!numberField.getText().matches("\\d{12}")){
				JOptionPane.showMessageDialog(this,"�������ѧ�Ų���ȷ��ѧ�ű�����ʮ��λ���ֹ��ɣ�",
						"ѧ�ŷǷ�",JOptionPane.WARNING_MESSAGE);
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
					JOptionPane.showMessageDialog(this,"�������ѧ�Ų����ڣ����������룡",
						"ѧ�Ŵ���",JOptionPane.ERROR_MESSAGE);
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

