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
	String [] labelNames={"����Ҫ�޸���Ϣ��ѧ�ţ�","(��)������","(��)�Ա�","(��)ѧԺ��","(��)רҵ��","(��)�༶��"};
	JTextField numberField,nameField,classField;
	JRadioButton maleRadiobutton,femaleRadiobutton;
	JComboBox<String> schoolCombo,majorCombo;
	String [] schoolName={"��Ϣ��ͨ�Ź���ѧԺ","�ֻ�����ѧԺ","����ѧԺ","��óѧԺ"},majorName[]={{"�������","��������","�������ѧ�뼼��","ͨ�Ź���","������Ϣ����"},{"�ֻ�����","���ӵ�������",},{"����Ӣ��","���ι���"},{"��������","����ó��"}};
	String regex = "^[\u4e00-\u9fa5]{0,4}";//��������ƥ�䣨�������룬����������೤��Ϊ4��
	JButton modifyButton,resetButton,queryButton;
	DBConnection dbc;
     
	public void init(){
		Font labelFont=new Font("����",Font.PLAIN ,20);
		labels=new JLabel[6];
		for(int i=0;i<6;i++){
			labels[i]=new JLabel(labelNames[i],JLabel.CENTER );
			labels[i].setFont(labelFont);
			
		}
		numberField=new JTextField(12);
		queryButton=new JButton("��ѯ");
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
		maleRadiobutton=new JRadioButton("��",true);
		femaleRadiobutton=new JRadioButton("Ů");
		maleRadiobutton.setFont(labelFont);
		femaleRadiobutton.setFont(labelFont);
		
		sexGroup.add(maleRadiobutton);
		sexGroup.add(femaleRadiobutton);
		
		schoolCombo=new JComboBox<String>(schoolName);
		schoolCombo.setFont(labelFont);
		schoolCombo.addItemListener(this);//ע�������
		majorCombo=new JComboBox<String>(majorName[0]);
		majorCombo.setFont(labelFont);
		
		modifyButton=new JButton("�޸�");
		modifyButton.setFont(labelFont);
		modifyButton.addActionListener(this);
		resetButton=new JButton("����");
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
		if(arg0.getActionCommand().equals("����")){
			numberField.setText("");
			nameField.setText("");
			classField.setText("");
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
			 			JOptionPane.showMessageDialog(this,"�������ѧ�Ų����ڣ����������룡",
							"ѧ���ظ�",JOptionPane.ERROR_MESSAGE);
			 			numberField.requestFocus();
			 			numberField.selectAll();
			 		}
			 		else {
			 			JOptionPane.showMessageDialog(this,"���ڴ�ѧ�ţ�",
								"ѧ�Ŵ���",JOptionPane.PLAIN_MESSAGE);
			 			
			 			String[] array=dbc.selectRecord(numberField.getText());
						nameField.setText(array[1]);
						if(array[2].equals("��")){
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
		else if(arg0.getActionCommand().equals("�޸�")){
				try {
					if(dbc==null||dbc.getCon()==null||dbc.con.isClosed()) {
						dbc = new DBConnection();
						}
					} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
					}
				if(!isLegal(nameField.getText())){
					JOptionPane.showMessageDialog(this,"��������������淶������Ϊ�ջ�����ո�",
							"�����Ƿ�",JOptionPane.WARNING_MESSAGE);
					nameField.requestFocus();
					nameField.selectAll();				
				}else if(!nameField.getText().matches(regex)) {
					JOptionPane.showMessageDialog(this,"��������������淶������Ϊ�����Ļ�������������4����",
							"�����Ƿ�",JOptionPane.WARNING_MESSAGE);
					nameField.requestFocus();
					nameField.selectAll();
				}else if(!isLegal(classField.getText())){
					JOptionPane.showMessageDialog(this,"������İ༶���淶���༶Ϊ�ջ�����ո�",
							"�༶�Ƿ�",JOptionPane.WARNING_MESSAGE);
					classField.requestFocus();
					classField.selectAll();
					}
					
				else{//�ҽ�������еĲ����ɾ���ĺ�����û�����¸���Update�������дһ������
						int n=JOptionPane.showConfirmDialog(this,"��ȷ��Ҫ�޸ģ�",
								"�޸���ʾ",JOptionPane.YES_NO_OPTION);
					if(n==JOptionPane.YES_OPTION) {
						String strs=numberField.getText();
							dbc.deleteRecord(strs);
						String sex ="��";
					if(femaleRadiobutton.isSelected())sex ="Ů";
						String news[]={numberField.getText(),nameField.getText(),sex,(String)schoolCombo.getSelectedItem(),
								(String)majorCombo.getSelectedItem(),classField.getText()};
					if(dbc.insertRecord(news)) {
						JOptionPane.showMessageDialog(this,"���޸ĵ�ѧ����Ϣ�ɹ���",
								"�޸���ʾ",JOptionPane.PLAIN_MESSAGE);
						numberField.setText("");
						nameField.setText("");
						classField.setText("");
						
					}else {
						JOptionPane.showMessageDialog(this,"���޸ĵ�ѧ����Ϣʧ�ܣ�",
								"�޸���ʾ",JOptionPane.ERROR_MESSAGE);
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
		 		JOptionPane.showMessageDialog(this,"�������ѧ�Ų��淶��ѧ��Ϊ�ջ�����ո�",
					"ѧ�ŷǷ�",JOptionPane.WARNING_MESSAGE);
		 		numberField.requestFocus();
		 		numberField.selectAll();
			
		 	}else if(!numberField.getText().matches("\\d{12}")){
		 		JOptionPane.showMessageDialog(this,"�������ѧ�Ų���ȷ��ѧ�ű�����ʮ��λ���ֹ��ɣ�",
					"ѧ�ŷǷ�",JOptionPane.WARNING_MESSAGE);
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
		 			JOptionPane.showMessageDialog(this,"�������ѧ�Ų����ڣ����������룡",
						"ѧ���ظ�",JOptionPane.ERROR_MESSAGE);
		 			numberField.requestFocus();
		 			numberField.selectAll();
		 		}
		 		else {
		 			JOptionPane.showMessageDialog(this,"���ڴ�ѧ�ţ�",
							"ѧ�Ŵ���",JOptionPane.PLAIN_MESSAGE);
		 			
		 			String[] array=dbc.selectRecord(numberField.getText());
					nameField.setText(array[1]);
					if(array[2].equals("��")){
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

