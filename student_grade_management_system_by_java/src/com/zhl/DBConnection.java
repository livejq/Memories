package com.zhl;
import java.sql.*;
/*
 *import java.beans.Statement; 
import java.sql.ResultSet;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
*/
public class DBConnection {
	String url="jdbc:mysql://localhost:3306/xuejidb";
	//解决端口被占用问题：以管理员身份打开命令行并输入netsh winsock reset
	String username="root";
	String password="liveJQ";
	
	Connection con=null;
	Statement stmt=null;
	ResultSet rs;
	String sql;
	String [] messages = new String[5];
	PreparedStatement prestmt;
	
	
	public DBConnection() {
		
		try {//1，加载驱动器类
				Class.forName("com.mysql.jdbc.Driver");
			} catch (ClassNotFoundException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		try {	//获得连接对象	
				con=DriverManager.getConnection(url,username,password);
			} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
	}
	
	
	public Connection getCon() {
		return con;
	}
	
	
	public boolean findByNumber(String number) {
		try {
			sql="select * from student where number =?";
			prestmt=con.prepareStatement(sql);
			prestmt.setString(1,number);
			rs=prestmt.executeQuery();//得到结果集
			if(rs!=null && rs.next())
				return true;
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return false;
	}


	public String[] selectRecord(String number) {
	
		try {
			String [] values=null;
			values=new String[6];
			sql="select * from student where number=?";
			prestmt=con.prepareStatement(sql);
			prestmt.setString(1,number);
			rs=prestmt.executeQuery();
		
			while(rs.next()) {
				for(int j=0;j<6;j++) {
					values[j]=rs.getString(j+1);				
				}	
			}
			return values;
		} catch (SQLException e) {
			e.printStackTrace();
		}
	return null;
	}
	
	
	public String[] getMessage(String number) {
		
		try {
			stmt=con.createStatement();
			sql="select * from student where number='"+number+"'";
			rs=stmt.executeQuery(sql);
			if(rs.next())
				for(int i=0;i<5;i++)
			      messages[i]=rs.getString(i+2);
			return messages;
		} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		return messages;
	}
	
	
	public String[][] getTableMassage(){
		int j=0;
		String [][] tablemessages=null;
		sql="select * from student";
		
		try {
			prestmt=con.prepareStatement(sql,ResultSet.TYPE_SCROLL_SENSITIVE);
			rs=prestmt.executeQuery(sql);
			rs.last();
			tablemessages = new String[rs.getRow()][6];
			rs.beforeFirst();
			while(rs.next()) {
				for(int i=0;i<6;i++)
			      tablemessages[j][i]=rs.getString(i+1);
				j++;
			}
               return tablemessages;
		} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		return tablemessages;	
	}
	
	
	public boolean insertRecord(String[] values) {
		try {
			sql="insert into student values(?,?,?,?,?,?)";
			prestmt=con.prepareStatement(sql);
			
			for(int i=0;i<values.length;i++) {
				prestmt.setString(i+1,values[i]);
			}
			if(prestmt.executeUpdate()==1){
				return true;
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
		 	e.printStackTrace();
		}
		return false;
	}
	
	public boolean deleteRecord(String number) {
		try {
			stmt=con.createStatement();
			sql="delete from student where number='"+number+"'";

			if(stmt.executeUpdate(sql)==1){
				return true;
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return false;
	}
	
	
public boolean 	updateRecord(String values[]){
		
		sql="update student set name=?,sex=?,school=?,major=?,class=? where number=?";
		try {
			prestmt=con.prepareStatement(sql);
			
			for(int i=0;i<values.length;i++)
				prestmt.setString(i+1, values[i]);
			if(prestmt.executeUpdate()==1) {
				return true;
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}
		return false;
	}
	
	public void close() {//在不需要的时候，把系统资源释放掉
			try {
				if(rs!=null)
					rs.close();
				if(stmt!=null)
					stmt.close();
				if(con!=null)
					con.close();
				
			} catch (SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
	}
}
