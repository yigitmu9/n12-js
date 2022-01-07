package com.pia.logger.model;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;

@Entity
@Table(name="log")
public class Log {

	@Id
	@Column(name="id")
    private String id;
    
	@Column(name="nickname", nullable=false)
    private String nickname;

	@Column(name="log", nullable=false)
    private String log;

	public Log() {
		super();
	}

	public Log(String id, String nickname, String log) {
		super();
		this.id = id;
		this.nickname = nickname;
		this.log = log;
	}

	public String getId() {
		return id;
	}

	public void setId(String id) {
		this.id = id;
	}

	public String getNickname() {
		return nickname;
	}

	public void setNickname(String nickname) {
		this.nickname = nickname;
	}

	public String getLog() {
		return log;
	}

	public void setLog(String log) {
		this.log = log;
	}  
}
