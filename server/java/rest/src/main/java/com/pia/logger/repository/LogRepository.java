package com.pia.logger.repository;

import org.springframework.data.jpa.repository.JpaRepository;

import com.pia.logger.model.Log;

public interface LogRepository extends JpaRepository<Log, String> {
	
}
